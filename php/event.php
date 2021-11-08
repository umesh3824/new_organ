<?php
class Event extends Record{
    public $DBObj;
    public $addSql="INSERT INTO events(eventTitle,eventLoginId,eventPassword,eventOpenToAll,eventIsLive,eventIsWebinar,eventCreator,img1,img2) VALUES (?,?,?,?,?,?,?,?,?)";
    public $updateSql="UPDATE events SET eventTitle=?,eventPassword=?,eventOpenToAll=?,eventIsLive=?,eventIsWebinar=? WHERE eventId=?";
    public $deleteSql="DELETE FROM events WHERE eventId=?";
    public $selectAllSql="SELECT * FROM events";
    public $selectSingleSql="SELECT * FROM events WHERE eventId=?";
    public $checkLoginIdSql="SELECT * FROM events WHERE eventLoginId=?";


    public $selectAllEventSql="SELECT * FROM events WHERE eventId!=?";
    public $selectEventByOwnerIdSql="SELECT * FROM events WHERE eventCreator=? OR eventId IN (SELECT DISTINCT(user_event.uv_event_id) FROM user_event WHERE user_event.uv_user_id=?)";

    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addEvent($data){
        $param_type="ssssssiss";
        return $this->DBObj->insert($this->addSql,$param_type,$data,"Event has been added.","Operation failed");;
    }
    public function updateEvent($data){
        $param_type="sssssi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"Event has been update.","Operation failed");;
    }
    public function deleteEvent($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"Event has been deleted.","Operation failed");;
    }
    public function selectAllEvent(){
        return $this->DBObj->selectAll($this->selectAllSql,"All events.","Operation failed");
    }
    public function selectSingleEvent($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
    public function checkLoginId($data){
        $param_type="s";
        return $this->DBObj->select($this->checkLoginIdSql,$param_type,$data,"This id is alredy used, try another.","This id is available.");
    }
    public function getAllEventByUser(){
        $sql=isAdmin()?$this->selectAllEventSql:$this->selectEventByOwnerIdSql;
        $param_type=isAdmin()?"i":"ii";
        $data=isAdmin()?[0]:[$_SESSION['user_id'],$_SESSION['user_id']];
        return $this->DBObj->select($sql,$param_type,$data,"Single Event","Operation failed");
    }
    public function getAllCustomerEvents($userId){
        $param_type="s";
        $indata=$this->DBObj->select("SELECT eventId as id FROM events WHERE eventOpenToAll=?",$param_type,["YES"],"Single event","Operation failed");
        $openToAll=$indata['data'];

        $param_type="s";
        $indata=$this->DBObj->select("SELECT uv_event_id as id FROM user_event WHERE uv_user_id=?",$param_type,[$userId],"Single event","Operation failed");
        $assignedEvent=$indata['data'];
        $eventIds=[];
        foreach(array_merge($openToAll,$assignedEvent) as $data){
            $eventIds[]=$data['id'];
        }

        if(count($eventIds)>0){
            $param_type=str_repeat('i', count($eventIds))."s";
            $param_para=str_repeat('?,', count($eventIds)-1)."?";
            $eventIds[]="YES";
            $indata=$this->DBObj->select("SELECT * FROM events WHERE eventId IN($param_para) AND eventIsLive=?",$param_type,$eventIds,"Single event","Operation failed");
        }
        else{
            $indata['status']=FALSE;
            $indata['data']=[];
            $indata['message']="Event is not assigned to you.";
        }
        return $indata;
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>