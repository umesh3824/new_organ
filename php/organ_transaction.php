<?php
class OrganTransaction extends Record{
    public $DBObj;
    public $addDonarOTSql="INSERT INTO organ_transaction(donar_id) VALUES (?)";
    public $addRecipientOTSql="UPDATE organ_transaction SET recipient_id=? WHERE ot_id=?";
    
    public $selectAllSql="SELECT * FROM organ INNER JOIN donar ON donar.organ_id=organ.organ_id INNER JOIN organ_transaction ON donar.donar_id=organ_transaction.donar_id INNER JOIN recipient ON recipient.recipient_id=organ_transaction.recipient_id WHERE recipient.process_status='SUCCESS'";
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addDonarOT($data){
        $param_type="i";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"OT has been added.","Operation failed");
    }
    public function addRecipientOT($data){
        $param_type="ii";
        return $this->DBObj->update($this->addRecipientOTSql,$param_type,$data,"OT has been update.","Operation failed");
    }
    public function selectAllOT(){
        return $this->DBObj->selectAll($this->selectAllSql,"All organ.","Operation failed");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>