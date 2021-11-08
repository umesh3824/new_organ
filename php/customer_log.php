<?php
class CustomerLog extends Record{
    public $DBObj;
    public $addCTLogSql="INSERT INTO customer_log(senderId,receiverId,ammountAmt,rechargeValidity,massege,transactionType) VALUES (?,?,?,?,?,?)";
    public $allCLogSql="SELECT * FROM customer_log WHERE logId!=? ORDER BY actionTime DESC";
    public $CLogByCreatorSql="SELECT * FROM customer_log WHERE senderId=? ORDER BY actionTime DESC";

    public $getCLogByIdSql="SELECT * FROM customer_log WHERE receiverId=? ORDER BY actionTime DESC";
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addCTLog($data){
        $param_type="iiisss";
        $indata=$this->DBObj->insert($this->addCTLogSql,$param_type,$data,"Log has been added.","Operation failed");
        return $indata;
    }
    // public function addNewRLog($data){
    //     $param_type="iisss";
    //     $indata=$this->DBObj->insert($this->addNewRLogSql,$param_type,$data,"Log has been added.","Operation failed");
    //     return $indata;
    // }
    public function getAllCLog(){
        $sql=isAdmin()?$this->allCLogSql:$this->CLogByCreatorSql;
        $param_type=isAdmin()?"i":"i";
        $data=isAdmin()?[0]:[$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getCLogById($custId){
        $param_type="i";
        return $this->DBObj->select($this->getCLogByIdSql,$param_type,[$custId],"Single user","Operation failed");
    }
}
?>