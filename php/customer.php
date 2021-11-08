<?php
class Customer extends Record{
    public $DBObj;
    public $addUserSql="INSERT INTO users(userName,userContactNo,userLoginId,userPassword,userRole,accountStatus,referedId) VALUES (?,?,?,?,?,?,?)";
    public $addCustomerSql="INSERT INTO customer(custId,custType,rechargeValidity,rechargeDate,rechargeReturnStatus) VALUES (?,?,?,?,?)";
    public $selectAllSql="SELECT * FROM users INNER JOIN customer ON users.userId=customer.custId";
    public $updateCustIPStatusSql="UPDATE customer SET loginIP=?,loginStatus=?,loginOn=?,loginToken=? WHERE custId=?";
    public $checkLoginSql="SELECT * FROM users INNER JOIN customer ON users.userId=customer.custId WHERE users.accountStatus=? AND customer.blockStatus=? AND (customer.custType=? OR customer.rechargeValidity>=?) AND users.userLoginId=? AND users.userPassword=?;";
    
    public $debitPointSql="UPDATE reseller_distributor SET creditBalance=IF(creditBalance>=?,creditBalance-?,creditBalance) WHERE rdId=?";
    public $creditPointSql="UPDATE reseller_distributor SET creditBalance=creditBalance+? WHERE rdId=?";
    public $userRechargeSql="UPDATE customer SET custType=?,rechargeValidity=IF(rechargeValidity>=now(),DATE_ADD(rechargeValidity, INTERVAL ? MONTH),DATE_ADD(now(), INTERVAL ? MONTH)),rechargeDate=?,rechargeReturnStatus=?,blockStatus=? WHERE custId=?";

    public $selectAllCustSql="SELECT users.userId,users.userName,users.userLoginId,users.userPassword,users.userContactNo,users.referedId,customer.custType,customer.rechargeValidity,customer.blockStatus,customer.loginIP,customer.loginStatus,customer.loginOn,customer.loginToken FROM users INNER JOIN customer ON users.userId=customer.custId WHERE users.userRole=? AND users.accountStatus!=? ORDER BY customer.blockStatus,customer.custType,customer.rechargeValidity";
    public $selectCustByReferedIdSql="SELECT users.userId,users.userName,users.userLoginId,users.userPassword,users.userContactNo,users.referedId,customer.custType,customer.rechargeValidity,customer.blockStatus,customer.loginIP,customer.loginStatus,customer.loginOn,customer.loginToken FROM users INNER JOIN customer ON users.userId=customer.custId WHERE users.userRole=? AND users.referedId=? AND users.accountStatus!=? ORDER BY customer.custType,customer.rechargeValidity";

    public $selectSingleCustomerSql="SELECT * FROM users INNER JOIN customer ON users.userId=customer.custId WHERE users.userId=?";
    public $blockCustSql="UPDATE customer SET blockDate=?,blockStatus=? WHERE custId=?";
    public $unBlockCustSql="UPDATE customer SET rechargeValidity=IF(now()>blockDate AND blockDate<rechargeValidity,DATE_ADD(IF(rechargeValidity>now(),rechargeValidity,now()), INTERVAL DATEDIFF(now(),blockDate) DAY),rechargeValidity),blockStatus=? WHERE custId=?";
    
    public $returnRechargeReqSql="UPDATE customer SET blockDate=?,blockStatus=?,rechargeReturnStatus=? WHERE custId=?";
    public $returnRechargeCancelSql="UPDATE customer SET rechargeValidity=IF(now()>blockDate AND blockDate<rechargeValidity,DATE_ADD(IF(rechargeValidity>now(),rechargeValidity,now()), INTERVAL DATEDIFF(now(),blockDate) DAY),rechargeValidity),blockStatus=?,rechargeReturnStatus=? WHERE custId=?";

    public $getAllReturnReachargeRequestSql="SELECT * FROM users INNER JOIN customer ON users.userId=customer.custId WHERE customer.rechargeReturnStatus=?";
    public $getUserRRRByIdSql="SELECT * FROM users INNER JOIN customer ON users.userId=customer.custId WHERE customer.rechargeReturnStatus=? AND users.referedId IN (SELECT userId FROM users WHERE referedId=?)";

    public $getAllRRRCountSql="SELECT count(*) userCount FROM users INNER JOIN customer ON users.userId=customer.custId WHERE customer.rechargeReturnStatus=?";
    public $getUserRRRCountByIdSql="SELECT count(*) userCount FROM users INNER JOIN customer ON users.userId=customer.custId WHERE customer.rechargeReturnStatus=? AND users.referedId IN (SELECT userId FROM users WHERE referedId=?)";

    public $getLastRechargeLogSql="SELECT * FROM customer_log WHERE (transactionType=? OR transactionType=?) AND receiverId=? ORDER BY actionTime DESC";

    public $acceptReturnRechargeSql="UPDATE customer SET rechargeValidity=?,rechargeDate=?,rechargeReturnStatus=?,blockStatus=? WHERE custId=?";
    
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addCustomer($data){
        global $CLogObj;
        $expiryDate='';
        $ammount=0;
        if($data['validity']=="TRIAL"){
            $userType='TRIAL';
            $expiryDate = date("Y-m-d", time() + (43200));
        }
        elseif($data['validity']=="DEMO"){
            $userType='DEMO';
            $expiryDate = date("Y-m-d", time());
        }
        else {
            $userType='REAL';
            $expiryDate = date("Y-m-d", time() + (86400*(30*$data['validity'])));
            $ammount=$data['validity'];
        }
        if($_SESSION['userRole']!="ADMIN" && $userType=='REAL'){
            $param_type="iii";
            $indata=$this->DBObj->update($this->debitPointSql,$param_type,[$data['validity'],$data['validity'],$_SESSION['user_id']],"Point updated.","Your balance is insufficient.");
            if($indata['status']==FALSE) return $indata;
        }

        $param_type="sssssss";
        $userData=[$data['name'],$data['contactNo'],$data['loginId'],$data['password'],"CUSTOMER","ACTIVE",$_SESSION['user_id']];
        $indata=$this->DBObj->insert($this->addUserSql,$param_type,$userData,"User has been added.","Operation failed");
        if($indata['status']==true){
            $insertedId=$indata['data']['insertedId'];
            $param_type="issss";
            $userData=[$insertedId,$userType,$expiryDate,date("Y-m-d", time()),"NO"];
            $indata=$indata=$this->DBObj->insert($this->addCustomerSql,$param_type,$userData,"Customer has been added.","Operation failed");
             if($indata['status']==TRUE)
                $CLogObj->addCTLog([$_SESSION['user_id'],$insertedId,$ammount,$expiryDate,strtolower($userType),"NEWUSER"]);
        }
        return $indata;
    }
    public function rechargeCustomer($data){
        global $CLogObj;
        if($data['month']=="NA" || $data['userId']=="NA"){
            $indata['message']="Please select user and no of month.";
            $indata['status']=false;
            return $indata;
        }

        if($_SESSION['userRole']!="ADMIN"){
            $param_type="iii";
            $indata=$this->DBObj->update($this->debitPointSql,$param_type,[$data['month'],$data['month'],$_SESSION['user_id']],$data['month']." month reacharge successful.","Your balance is insufficient.");
            if($indata['status']==FALSE) return $indata;
        }
        $param_type="siisssi";
        $nowdate=date("Y-m-d", time());
        $indata=$this->DBObj->update($this->userRechargeSql,$param_type,["REAL",$data['month'],$data['month'],$nowdate,"NO","NO",$data['userId']],$data['month']." month reacharge successful.","Operation failed.");
        
        if($indata['status']==TRUE)
                $CLogObj->addCTLog([$_SESSION['user_id'],$data['userId'],$data['month'],$this->getRechargeValidity([$data['userId']]),"reachrage","RECHARGE"]);

        return $indata;
   }
    public function selectAllCustomers(){
        return $this->DBObj->selectAll($this->selectAllSql,"All user","Operation failed");
    }
    public function getAllCustomersByUser(){
        $sql=isAdmin()?$this->selectAllCustSql:$this->selectCustByReferedIdSql;
        $param_type=isAdmin()?"ss":"sis";
        $data=isAdmin()?['CUSTOMER',"DEACTIVE"]:['CUSTOMER',$_SESSION['user_id'],"DEACTIVE"];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getRechargeValidity($data){
        $param_type="i";
        $indata=$this->DBObj->select($this->selectSingleCustomerSql,$param_type,$data,"Single user","Operation failed");

        return $indata['data'][0]['rechargeValidity'];
    }
    public function blockCustomer($custId){
        global $CLogObj;
        $param_type="ssi";
        $bdate=date("Y-m-d", time());
        $indata=$this->DBObj->update($this->blockCustSql,$param_type,[$bdate,"YES",$custId],"User has been blocked.","Operation failed.");
        if($indata['status']==TRUE)
                $CLogObj->addCTLog([$_SESSION['user_id'],$custId,'0','0',"block","BLOCK"]);

        return $indata;        
    }
    public function unBlockCustomer($custId){
        global $CLogObj;
        $param_type="si";
        $indata=$this->DBObj->update($this->unBlockCustSql,$param_type,["NO",$custId],"User has been Unblock.","Operation failed.");
        if($indata['status']==TRUE)
            $CLogObj->addCTLog([$_SESSION['user_id'],$custId,'0','0',"UnBlock","UNBLOCK"]);
        return $indata;        
    }
    public function returnRechargeRequest($custId){
        global $CLogObj;
        $param_type="sssi";
        $bdate=date("Y-m-d", time());
        $indata=$this->DBObj->update($this->returnRechargeReqSql,$param_type,[$bdate,"YES","PENDING",$custId],"Request has been sent.","Operation failed.");
        if($indata['status']==TRUE)
            $CLogObj->addCTLog([$_SESSION['user_id'],$custId,'0','0',"return","RETURNREQUEST"]);
        return $indata;        
    }
    public function returnRechargeCancel($custId){
        global $CLogObj;
        $param_type="ssi";
        $indata=$this->DBObj->update($this->returnRechargeCancelSql,$param_type,["NO","NO",$custId],"Request has been cancel.","Operation failed.");
        if($indata['status']==TRUE)
            $CLogObj->addCTLog([$_SESSION['user_id'],$custId,'0','0',"return cancel","RETURNREQUESTCANCEL"]);
        return $indata;        
    }
    public function getSingleCustomer($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleCustomerSql,$param_type,$data,"Single user","Operation failed");
    }
    public function getAllReturnReachargeRequest(){
        $sql=isAdmin()?$this->getAllReturnReachargeRequestSql:$this->getUserRRRByIdSql;
        $param_type=isAdmin()?"s":"si";
        $data=isAdmin()?["PENDING"]:["PENDING",$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getRRRCount(){
        $sql=isAdmin()?$this->getAllRRRCountSql:$this->getUserRRRCountByIdSql;
        $param_type=isAdmin()?"s":"si";
        $data=isAdmin()?["PENDING"]:["PENDING",$_SESSION['user_id']];
        $indata=$this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");

        return $indata['data'][0]['userCount'];
    }
    public function getLastRechargeLog($logId){
        $param_type="ssi";
        return $this->DBObj->select($this->getLastRechargeLogSql,$param_type,["RECHARGE","NEWUSER",$logId],"Single Log","Operation failed");
    }
    public function acceptReturnRecharge($userId){
        global $CLogObj;
        global $userObj;
        $indata=$this->getLastRechargeLog($userId);
        $logsData=$indata['data'];
        $param_type="ii";
        if($userObj->getUserRole($userId)!="ADMIN")
            $indata=$this->DBObj->update($this->creditPointSql,$param_type,[$logsData[0]['ammountAmt'],$logsData[0]['senderId']],"Balance is credited to Reseller.","Operation failed.");

        if(isAdmin() || $indata['status']){
            $rechargeValidity='0';
            $lastRechargeDate='0';
            if(count($logsData)>=2){
                $rechargeValidity=$logsData[1]['rechargeValidity'];
                $lastRechargeDate=$logsData[1]['actionTime'];
            }
          
            $param_type="ssssi";
            $data=[$rechargeValidity,$lastRechargeDate,"YES","NO",$userId];
            $indata=$this->DBObj->update($this->acceptReturnRechargeSql,$param_type,$data,"Refund request accepted.","Operation failed.");

            if($indata['status']==TRUE)
                $CLogObj->addCTLog([$_SESSION['user_id'],$userId,'0','0',"return request accepted","REQUESTACCEPTED"]);
        }


        return $indata;
    }
    public function updateCustomerIPStatus($data){
        $param_type="ssssi";
        return $this->DBObj->update($this->updateCustIPStatusSql,$param_type,$data,"Data has been updated.","Operation failed.");
    }
    public function checkLogin($userData){
        $param_type="ssssss";
        $todayDate=date("Y-m-d", time());
        $data=["ACTIVE","NO","DEMO",$todayDate,$userData['userLoginId'],$userData['userPassword']];
        return $this->DBObj->select($this->checkLoginSql,$param_type,$data,"Logged in successful.","Login failed, Enter correct credenctials.");
    }
    // public function login($data){
    //     $param_type="ss";
    //     return $this->DBObj->select($this->loginSql,$param_type,$data,"Login successful.","Login failed,please check login credentials.");
    // }
    // public function checkLoginId($data){
    //     $param_type="s";
    //     return $this->DBObj->select($this->checkLoginIdSql,$param_type,$data,"This id is alredy used, try another.","This id is available.");
    // }
}
?>