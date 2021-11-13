<?php
class Organ extends Record{
    public $DBObj;
    public $addSql="";
    public $updateSql="";
    public $deleteSql="DELETE FROM organ WHERE organ_id=?";
    public $selectAllSql="SELECT * FROM organ";
    public $selectSingleSql="SELECT * FROM organ WHERE organ_id=?";
    
    public $searchOrganSql="SELECT * FROM organ_transaction INNER JOIN donar ON donar.donar_id=organ_transaction.donar_id INNER JOIN organ ON organ.organ_id=donar.organ_id WHERE donar.organ_id=? AND organ_transaction.recipient_id=0";
    public $getOrganIdByOTIdSql="SELECT * FROM organ_transaction INNER JOIN donar ON donar.donar_id=organ_transaction.donar_id INNER JOIN organ ON organ.organ_id=donar.organ_id WHERE organ_transaction.ot_id=?";
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addOrgan($data){
        $param_type="sssssss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Organ has been added.","Operation failed");
    }
    public function updateOrgan($data){
        $param_type="sssssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Organ has been update.","Operation failed");
    }
    public function deleteOrgan($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Organ has been deleted.","Operation failed");
    }
    public function selectAllOrgans(){
        return $this->DBObj->selectAll($this->selectAllSql,"All organ.","Operation failed");
    }
    public function selectSingleOrgan($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
    public function searchOrgan($organ_id){
        $param_type="i";
        return $this->DBObj->select($this->searchOrganSql,$param_type,[$organ_id],"Organ is available.","Organ is not available.");
    }
    public function getOrganIdByOTId($OT_id){
        $param_type="i";
        return $this->DBObj->select($this->getOrganIdByOTIdSql,$param_type,[$OT_id],"Organ is available.","Organ is not available.");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>