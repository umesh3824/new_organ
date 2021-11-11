<?php
class Donar extends Record{
    public $DBObj;
    public $addSql="INSERT INTO donar(donar_name,donar_email,donar_contactno,donar_dob,donar_address,organ_id) VALUES (?,?,?,?,?,?)";
    public $updateSql="UPDATE donar SET donar_name=?,donar_email=?,donar_contactno=?,donar_dob=?,donar_address=?,organ_id=? WHERE donar_id=?";
    public $deleteSql="DELETE FROM donar WHERE donar_id=?";
    public $selectByStatusSql="SELECT * FROM donar WHERE process_status=?";
    public $selectAllByStatusSql="SELECT * FROM donar WHERE process_status!=?";
    public $selectSingleSql="SELECT * FROM donar WHERE donar_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addDonar($data){
        $param_type="sssssi";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Donar has been registered.","Operation failed");
    }
    public function updateDonar($data){
        $param_type="sssssii";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Donar has been update.","Operation failed");
    }
    public function deleteDonar($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Donar has been deleted.","Operation failed");
    }
    public function selectAllDonarsByStatus($status){
        $sql=$status=="ALL"?$this->selectAllByStatusSql:$this->selectByStatusSql;
        $param_type="s";
        return $this->DBObj->select($sql,$param_type,[$status],"All Donar.","Operation failed");
    }
    public function selectSingleDonar($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>