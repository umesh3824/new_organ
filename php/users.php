<?php
class Users extends Record{
    public $DBObj;
    public $updateSql="UPDATE users SET userName=?,userContactNo=?,userPassword=? WHERE userId=?";
    public $updatePasswordSql="UPDATE users SET userPassword=? WHERE userId=?";
    public $selectSingleSql="SELECT * FROM users WHERE userId=?";
    public $loginSql="SELECT * FROM users WHERE userLoginId=? AND userPassword=? AND userRole!=?";
    public $checkLoginIdSql="SELECT * FROM users WHERE userLoginId=?";
    public $deleteUserSql="UPDATE users SET accountStatus=? WHERE userId=?";
    
    public $getAdminUserSql="SELECT * FROM users LEFT JOIN user_event ON (users.userId=user_event.uv_user_id AND user_event.uv_event_id=?) WHERE users.userRole=? ORDER BY users.userName";
    public $getResellerUserSql="SELECT * FROM users LEFT JOIN user_event ON (users.userId=user_event.uv_user_id AND user_event.uv_event_id=?) WHERE users.userRole=? AND users.referedId=? ORDER BY users.userName";

    public $assignEventSql="INSERT INTO user_event(uv_user_id,uv_event_id) VALUES (?,?)";
    public $removeAssignedEventSql="DELETE FROM user_event WHERE uv_user_id=? AND uv_event_id=?";

    public $selectAllEventForAssignSingleSql="SELECT events.eventId,events.eventId,events.eventTitle,events.eventLoginId,events.eventPassword,events.eventIsLive,user_event.uv_id,user_event.uv_user_id,user_event.uv_event_id FROM events LEFT JOIN user_event ON events.eventId=user_event.uv_event_id AND user_event.uv_user_id=? ORDER BY events.eventId";
    public $selectEventByOwnerIdForAssignSingleSql="SELECT events.eventId,events.eventId,events.eventTitle,events.eventLoginId,events.eventPassword,events.eventIsLive,user_event.uv_id,user_event.uv_user_id,user_event.uv_event_id FROM events LEFT JOIN user_event ON events.eventId=user_event.uv_event_id AND user_event.uv_user_id=? WHERE events.eventId IN(SELECT events.eventId FROM events WHERE eventCreator=? OR eventId IN (SELECT DISTINCT(user_event.uv_event_id) FROM user_event WHERE user_event.uv_user_id=?)) ORDER BY events.eventId";

    public $getAllDeletedUserSql="SELECT * FROM users WHERE accountStatus=?";
    public $getDeletedUserSql="SELECT * FROM users WHERE referedId=? AND accountStatus=?";

    public $getUserCountsSql="SELECT count(*) as userCount FROM users WHERE accountStatus=? AND referedId=? AND userRole=?";
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function updateUser($data){
        $param_type="sssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"User has been update.","Operation failed");;
    }
    public function updatePassword($data){
        $param_type="si";
        return $this->DBObj->update($this->updatePasswordSql,$param_type,$data,"User password has been update.","Operation failed");;
    }
    public function selectSingleUser($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single user","Operation failed");
    }
    public function getUserCounts($id,$userRole){
        $param_type="sis";
        $data=["ACTIVE",$id,$userRole];
        $indata=$this->DBObj->select($this->getUserCountsSql,$param_type,$data,"Single user","Operation failed");
        return $indata['data'][0]['userCount'];
    }
    public function login($data){
        $param_type="sss";
        return $this->DBObj->select($this->loginSql,$param_type,$data,"Login successful.","Login failed,please check login credentials.");
    }
    public function checkLoginId($data){
        $param_type="s";
        return $this->DBObj->select($this->checkLoginIdSql,$param_type,$data,"This id is alredy used, try another.","This id is available.");
    }
    public function deleteUser($data){
        array_unshift($data,"DEACTIVE");
        $param_type="si";
        return $this->DBObj->update($this->deleteUserSql,$param_type,$data,"User has been deleted.","Operation failed");;
    }
    public function getUserForAssignEvent($userType,$eventId){
        $sql=isAdmin()?$this->getAdminUserSql:$this->getResellerUserSql;
        $param_type=isAdmin()?"is":"isi";
        $data=isAdmin()?[$eventId,$userType]:[$eventId,$userType,$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single user","Operation failed");
    }
    public function getAllEventByUserForAssignSingleUser($user_id){
        $sql=isAdmin()?$this->selectAllEventForAssignSingleSql:$this->selectEventByOwnerIdForAssignSingleSql;
        $param_type=isAdmin()?"i":"iii";
        $data=isAdmin()?[$user_id]:[$user_id,$_SESSION['user_id'],$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single Event","Operation failed");
    }
    function assignEvent($data){
        $param_type="ii";
        return $this->DBObj->insert($this->assignEventSql,$param_type,$data,"Event has been assigned.","Operation failed");
    }
    function removeAssignedEvent($data){
        $param_type="ii";
        return $this->DBObj->insert($this->removeAssignedEventSql,$param_type,$data,"Event removed.","Operation failed");
    }
    function getName($createrId){
        $param_type="i";
        $data=[$createrId];
        $indata=$this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single user","Operation failed");
        $name=$indata['data'][0]['userName'];
        return $name;
    }
    function getUserRole($userId){
        $param_type="i";
        $data=[$userId];
        $indata=$this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single user","Operation failed");
        $role=$indata['data'][0]['userRole'];
        return $role;
    }
    public function getAllDeletedUser(){
        $sql=isAdmin()?$this->getAllDeletedUserSql:$this->getDeletedUserSql;
        $param_type=isAdmin()?"s":"is";
        $data=isAdmin()?["DEACTIVE"]:[$_SESSION['user_id'],"DEACTIVE"];
        return $this->DBObj->select($sql,$param_type,$data,"Single Event","Operation failed");
    }
}
?>