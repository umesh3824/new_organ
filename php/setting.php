<?php
class Setting extends Record{
    public $DBObj;
    public $updateSql="UPDATE version_tbl SET version_name=? WHERE id=?";
    public $selectSingleSql="SELECT * FROM version_tbl WHERE id=?";

    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function updateSetting($data){
        $param_type="ss";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Setting has been update.","Operation failed");;
    }
    public function selectSingleSetting($data){
        $param_type="s";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Available Version","Operation failed.");
    }
}
?>