<?php
class Doctor extends Record{
    public $DBObj;
    public $addSql="INSERT INTO doctor(doctor_name,doctor_email,doctor_contactno,doctor_password,doctor_qualification, organization_name,address) VALUES (?,?,?,?,?,?,?)";
    public $updateSql="UPDATE events SET eventTitle=?,eventPassword=?,eventOpenToAll=?,eventIsLive=?,eventIsWebinar=? WHERE eventId=?";
    public $deleteSql="DELETE FROM events WHERE eventId=?";
    public $selectAllSql="SELECT * FROM doctor";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addDoctor($data){
        $param_type="sssssss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Doctor has been added.","Operation failed");;
    }
    public function updateEvent($data){
        $param_type="sssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Event has been update.","Operation failed");;
    }
    public function deleteEvent($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Event has been deleted.","Operation failed");;
    }
    public function selectAllDoctors(){
        return $this->DBObj->selectAll($this->selectAllSql,"All doctor.","Operation failed");
    }
    public function selectSingleEvent($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>