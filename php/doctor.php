<?php
class Doctor extends Record{
    public $DBObj;
    public $addSql="INSERT INTO doctor(doctor_name,doctor_email,doctor_contactno,doctor_password,doctor_qualification, organization_name,address) VALUES (?,?,?,?,?,?,?)";
    public $updateSql="UPDATE doctor SET doctor_name=?,doctor_email=?,doctor_contactno=?,doctor_password=?,doctor_qualification=?,organization_name=?,address=? WHERE doctor_id=?";
    public $deleteSql="DELETE FROM doctor WHERE doctor_id=?";
    public $selectAllSql="SELECT * FROM doctor";
    public $selectSingleSql="SELECT * FROM doctor WHERE doctor_id=?";
    
    public $loginSql="SELECT * FROM doctor WHERE  doctor_email=? AND doctor_password=?";

    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addDoctor($data){
        $param_type="sssssss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Doctor has been added.","Operation failed");
    }
    public function updateDoctor($data){
        $param_type="sssssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Doctor has been update.","Operation failed");
    }
    public function deleteDoctor($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Doctor has been deleted.","Operation failed");
    }
    public function selectAllDoctors(){
        return $this->DBObj->selectAll($this->selectAllSql,"All doctor.","Operation failed");
    }
    public function selectSingleDoctor($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
    public function login($data){
        $param_type="ss";
        return $this->DBObj->select($this->loginSql,$param_type,$data,"Login successful.","Enter correct credentials.");
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>