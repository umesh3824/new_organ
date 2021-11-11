<?php
class Recipient extends Record{
    public $DBObj;
    public $addSql="INSERT INTO recipient(recipient_name,recipient_email,recipient_contactno,recipient_dob,recipient_address,organ_id) VALUES (?,?,?,?,?,?)";
    public $updateSql="UPDATE recipient SET recipient_name=?,recipient_email=?,recipient_contactno=?,recipient_dob=?,recipient_address=?,organ_id=? WHERE recipient_id=?";
    public $deleteSql="DELETE FROM recipient WHERE recipient_id=?";
    public $selectAllByStatusSql="SELECT * FROM recipient WHERE process_status!=?";
    public $selectByStatusSql="SELECT * FROM recipient WHERE process_status=?";
    public $selectSingleSql="SELECT * FROM recipient WHERE recipient_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addRecipient($data){
        $param_type="sssssi";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Recipient has been registered.","Operation failed");
    }
    public function updateRecipient($data){
        $param_type="sssssii";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Recipient has been update.","Operation failed");
    }
    public function deleteRecipient($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Recipient has been deleted.","Operation failed");
    }
    public function selectAllRecipientsByStatus($status){
        $sql=$status=="ALL"?$this->selectAllByStatusSql:$this->selectByStatusSql;
        $param_type="s";
        return $this->DBObj->select($sql,$param_type,[$status],"All Recipient.","Operation failed");
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