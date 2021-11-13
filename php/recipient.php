<?php
class Recipient extends Record{
    public $DBObj;
    public $addSql="INSERT INTO recipient(recipient_name,recipient_email,recipient_contactno,recipient_dob,recipient_address,organ_id) VALUES (?,?,?,?,?,?)";
    public $updateSql="UPDATE recipient SET recipient_name=?,recipient_email=?,recipient_contactno=?,recipient_dob=?,recipient_address=? WHERE recipient_id=?";
    public $deleteSql="DELETE FROM recipient WHERE recipient_id=?";
    public $selectAllByStatusSql="SELECT * FROM recipient WHERE process_status!=?";
    public $selectByStatusSql="SELECT * FROM recipient WHERE process_status=?";
    public $selectSingleSql="SELECT * FROM recipient INNER JOIN organ ON recipient.organ_id=organ.organ_id WHERE recipient_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addRecipient($data,$ot_id){
        $param_type="i";
        $indata=$this->DBObj->select("SELECT * FROM organ_transaction WHERE recipient_id=0 AND ot_id=?",$param_type,[$ot_id],"Organ Id available.","Organ id not available.");
        if($indata['status']==FALSE){
            return $indata;
        }
        $param_type="ssssss";
        $indata=$this->DBObj->insert($this->addSql,$param_type,$data,"Recipient has been registered.","Operation failed");
        if($indata['status']==TRUE){
            $param_type="ii";
            $this->DBObj->update("UPDATE organ_transaction SET recipient_id=? WHERE ot_id=?",$param_type,[$indata['data']['insertedId'],$ot_id],"S.","F");
        }
        return $indata;
    }
    public function updateRecipient($data){
        $param_type="sssssi";
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