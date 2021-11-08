<?php
class Reseller extends Record{
    public $DBObj;
    public $addUserSql="INSERT INTO users(userName,userContactNo,userLoginId,userPassword,userRole,accountStatus,referedId) VALUES (?,?,?,?,?,?,?)";
    public $addResellerSql="INSERT INTO reseller_distributor(rdId,canCreateEvent,canCreateDistributor) VALUES (?,?,?)";
    public $updateUserSql="UPDATE users SET userName=?,userContactNo=?,userPassword=?,userRole=? WHERE userId=?";
    public $updateResellerSql="UPDATE reseller_distributor SET canCreateEvent=?,canCreateDistributor=? WHERE rdId=?";
    public $selectAllSql="SELECT * FROM users INNER JOIN reseller_distributor ON users.userId=reseller_distributor.rdId";
    public $selectSingleSql="SELECT * FROM users INNER JOIN reseller_distributor ON users.userId=reseller_distributor.rdId WHERE rdId=?";
    public $debitPointSql="UPDATE reseller_distributor SET creditBalance=IF(creditBalance>=?,creditBalance-?,creditBalance) WHERE rdId=?";
    public $creditPointSql="UPDATE reseller_distributor SET creditBalance=creditBalance+? WHERE rdId=?";

    public $allAdminResellerSql="SELECT * FROM users INNER JOIN reseller_distributor ON users.userId=reseller_distributor.rdId WHERE users.userRole=?";
    public $allResellerResellerSql="SELECT * FROM users INNER JOIN reseller_distributor ON users.userId=reseller_distributor.rdId WHERE users.userRole=? and users.referedId=?";

    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addReseller($data){
        global $RLogObj;

        $data['canCreateEvent']=test_input(@$_POST['canCreateEvent'])=="on"?"YES":"NO";
        $data['canCreateDistributor']=test_input(@$_POST['canCreateDistributor'])=="on"?"YES":"NO";

        $param_type="sssssss";
        $userData=[$data['name'],$data['contactNo'],$data['loginId'],$data['password'],$data['userType'],"ACTIVE",$_SESSION['user_id']];
        $indata=$this->DBObj->insert($this->addUserSql,$param_type,$userData,"User has been added.","Operation failed");
        if($indata['status']==true){
            $insertedId=$indata['data']['insertedId'];
            $param_type="iss";
            $userData=[$indata['data']['insertedId'],$data['canCreateEvent'],$data['canCreateDistributor']];
            $indata=$this->DBObj->insert($this->addResellerSql,$param_type,$userData,"User has been added.","Operation failed");
            if($indata['status']==TRUE)
                $RLogObj->addNewRLog([$_SESSION['user_id'],$insertedId,strtolower($data['userType']),"NEWUSER","NEWUSER"]);
        }
        return $indata;
    }
    public function updateReseller($data){
        $data['canCreateEvent']=test_input(@$_POST['canCreateEvent'])=="on"?"YES":"NO";
        $data['canCreateDistributor']=test_input(@$_POST['canCreateDistributor'])=="on"?"YES":"NO";

        $param_type="ssssi";
        $userData=[$data['name'],$data['contactNo'],$data['password'],$data['userType'],$data['userId']];
        $indata=$this->DBObj->update($this->updateUserSql,$param_type,$userData,"User has been Updated.","Operation failed");
        
        $param_type="ssi";
        $userData=[$data['canCreateEvent'],$data['canCreateDistributor'],$data['userId']];
        $indata=$this->DBObj->insert($this->updateResellerSql,$param_type,$userData,"User has been updated.","Operation failed");
        
        $indata['message']="User has been updated.";
        $indata['status']=TRUE;
        return $indata;
    }
    // public function selectAllResellers(){
    //         return $this->DBObj->selectAll($this->selectAllSql,"All user","Operation failed");
    // }
    public function selectSingleReseller($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single user","Operation failed");
    }
    public function getResellerByType($userRole){
        $sql=isAdmin()?$this->allAdminResellerSql:$this->allResellerResellerSql;
        $param_type=isAdmin()?"s":"si";
        $data=isAdmin()?[$userRole]:[$userRole,$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getPointCount($data){
        $param_type="i";
        $indata=$this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single user","Operation failed");
        return $indata['data'][0]['creditBalance'];
    }
    public function canCreateEvent(){
        $param_type="i";
        $indata=$this->DBObj->select($this->selectSingleSql,$param_type,[$_SESSION['user_id']],"Single user","Operation failed");
        return $indata['data'][0]['canCreateEvent']=="YES"?TRUE:FALSE;
    }
    public function canCreateDistributor(){
        $param_type="i";
        $indata=$this->DBObj->select($this->selectSingleSql,$param_type,[$_SESSION['user_id']],"Single user","Operation failed");
        return $indata['data'][0]['canCreateDistributor']=="YES"?TRUE:FALSE;
    }
    public function creditPoint($data){
        global $RLogObj;
        if($_SESSION['userRole']!="ADMIN"){
            $param_type="iii";
            $indata=$this->DBObj->update($this->debitPointSql,$param_type,[$data['ammount'],$data['ammount'],$_SESSION['user_id']],"Balance is debited.","Your balance is insufficient.");
            if($indata['status']==FALSE) return $indata;
        }
        $param_type="ii";
        $indata=$this->DBObj->update($this->creditPointSql,$param_type,[$data['ammount'],$data['receiverId']],"Balance is credited.","Operation failed.");

        if($indata['status']==TRUE)
            $RLogObj->addRTLog([$_SESSION['user_id'],$data['receiverId'],$data['ammount']." Points credited to ",$data['ammount'],"DEBIT","CREDIT"]);

        return $indata;
    }
    public function debitPoint($data){
        global $RLogObj;

        $param_type="iii";
        $indata=$this->DBObj->update($this->debitPointSql,$param_type,[$data['ammount'],$data['ammount'],$data['receiverId']],"Balance is debited.","User balance is insufficient.");
        
        if($_SESSION['userRole']!="ADMIN" && $indata['status']==TRUE){
            $param_type="ii";
            $indata=$this->DBObj->update($this->creditPointSql,$param_type,[$data['ammount'],$_SESSION['user_id']],"Balance is debited.","Operation failed.");
        }
        if($indata['status']==TRUE)
            $RLogObj->addRTLog([$_SESSION['user_id'],$data['receiverId'],$data['ammount']." Points debited from ",$data['ammount'],"CREDIT","DEBIT"]);
        return $indata;
    }
}
?>