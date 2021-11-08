<?php
class ResellerLog extends Record{
    public $DBObj;
    public $addRTLogSql="INSERT INTO reseller_log(senderId,receiverId,transactionAmt,message,STransactionType,RTransactionType) VALUES (?,?,?,?,?,?)";
    public $addNewRLogSql="INSERT INTO reseller_log(senderId,receiverId,message,STransactionType,RTransactionType) VALUES (?,?,?,?,?)";
    public $allRLogSql="SELECT * FROM reseller_log WHERE logId!=? ORDER BY actionTime DESC";
    public $RLogByCreatorSql="SELECT * FROM reseller_log WHERE senderId=? ORDER BY actionTime DESC";

    public $myHistorySql="SELECT * FROM reseller_log WHERE receiverId=? ORDER BY actionTime DESC";
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addRTLog($data){
        $param_type="iiisss";
        $indata=$this->DBObj->insert($this->addRTLogSql,$param_type,$data,"Log has been added.","Operation failed");
        return $indata;
    }
    public function addNewRLog($data){
        $param_type="iisss";
        $indata=$this->DBObj->insert($this->addNewRLogSql,$param_type,$data,"Log has been added.","Operation failed");
        return $indata;
    }
    public function getAllRLog(){
        $sql=isAdmin()?$this->allRLogSql:$this->RLogByCreatorSql;
        $param_type=isAdmin()?"i":"i";
        $data=isAdmin()?[0]:[$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getMyHistoryLog(){
        $param_type="i";
        $data=[$_SESSION['user_id']];
        return $this->DBObj->select($this->myHistorySql,$param_type,$data,"Single user","Operation failed");
    }
}
?>