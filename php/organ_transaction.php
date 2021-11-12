<?php
class OrganTransaction extends Record{
    public $DBObj;
    public $addDonarOTSql="INSERT INTO organ_transaction(donar_id) VALUES (?)";
    public $addRecipientOTSql="UPDATE organ_transaction SET recipient_id=? WHERE ot_id=?";
    
    // public $updateSql="";
    // public $deleteSql="DELETE FROM organ WHERE organ_id=?";
    // public $selectAllSql="SELECT * FROM organ";
    // public $selectSingleSql="SELECT * FROM organ WHERE organ_id=?";
  
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
    // public function updateOT($data){
    //     $param_type="sssssssi";
    //     return $this->DBObj->update($this->updateSql,$param_type,$data,"Organ has been update.","Operation failed");
    // }
    // public function deleteOT($data){
    //     $param_type="i";
    //     return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Organ has been deleted.","Operation failed");
    // }
    // public function selectAllOrgans(){
    //     return $this->DBObj->selectAll($this->selectAllSql,"All organ.","Operation failed");
    // }
    // public function selectSingleOrgan($data){
    //     $param_type="i";
    //     return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    // }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>