<?php
class Admin extends Record{
    public $DBObj;
    public $addSql="";
    public $updateSql="";
    public $deleteSql="";
    public $selectAllSql="SELECT * FROM admin";
    public $selectSingleSql="SELECT * FROM admin WHERE admin_id=?";

    public $loginSql="SELECT * FROM admin WHERE  admin_email=? AND admin_password=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addAdmin($data){
        $param_type="sssssss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Admin has been added.","Operation failed");
    }
    public function updateAdmin($data){
        $param_type="sssssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Admin has been update.","Operation failed");
    }
    public function deleteAdmin($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Admin has been deleted.","Operation failed");
    }
    public function selectAllAdmins(){
        return $this->DBObj->selectAll($this->selectAllSql,"All admin.","Operation failed");
    }
    public function selectSingleAdmin($data){
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