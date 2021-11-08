<?php
class Recipient extends Record{
    public $DBObj;
    public $addSql="INSERT INTO recipient(recipient_name,recipient_email,recipient_contactno,recipient_dob,recipient_address,recipient_password) VALUES (?,?,?,?,?,?)";
    public $updateSql="UPDATE recipient SET recipient_name=?,recipient_email=?,recipient_contactno=?,recipient_dob=?,recipient_address=?,recipient_password=? WHERE recipient_id=?";
    public $deleteSql="DELETE FROM recipient WHERE recipient_id=?";
    public $selectAllSql="SELECT * FROM recipient";
    public $selectSingleSql="SELECT * FROM recipient WHERE recipient_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addRecipient($data){
        $param_type="ssssss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Recipient has been registered.","Operation failed");;
    }
    public function updateRecipient($data){
        $param_type="ssssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Recipient has been update.","Operation failed");;
    }
    public function deleteRecipient($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Recipient has been deleted.","Operation failed");;
    }
    public function selectAllRecipients(){
        return $this->DBObj->selectAll($this->selectAllSql,"All Recipient.","Operation failed");
    }
    public function selectSingleRecipient($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>