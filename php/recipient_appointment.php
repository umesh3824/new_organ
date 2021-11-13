<?php
class RAppointment extends Record{
    public $DBObj;
    public $addSql="INSERT INTO recipient_appointment(recipient_id,doctor_id,ra_date) VALUES (?,?,?)";
    public $updateSql="UPDATE recipient_appointment SET recipient_id=?,doctor_id=?,ra_date=? WHERE ra_id=?";
    public $deleteSql="DELETE FROM recipient_appointment WHERE ra_id=?";
    public $selectAllSql="SELECT * FROM recipient_appointment";
    public $selectSingleSql="SELECT * FROM recipient_appointment INNER JOIN recipient ON recipient.recipient_id=recipient_appointment.recipient_id INNER JOIN organ ON recipient.organ_id=organ.organ_id WHERE recipient_appointment.ra_id=?";

    public $getAllAppbyDoctorIdSql="SELECT * FROM recipient_appointment INNER JOIN recipient ON recipient.recipient_id=recipient_appointment.recipient_id WHERE  recipient_appointment.doctor_id=?";
    public $getAssingedAppbyDoctorIdSql="SELECT * FROM recipient_appointment INNER JOIN recipient ON recipient.recipient_id=recipient_appointment.recipient_id WHERE recipient.process_status='SCHEDULE' AND recipient_appointment.ra_date>=now() AND recipient_appointment.doctor_id=?";
    public $getMissingAppbyDoctorIdSql="SELECT * FROM recipient_appointment INNER JOIN recipient ON recipient.recipient_id=recipient_appointment.recipient_id WHERE recipient.process_status='SCHEDULE' AND recipient_appointment.ra_date<now() AND recipient_appointment.doctor_id=?";
    public $getDoneAppbyDoctorIdSql="SELECT * FROM recipient_appointment INNER JOIN recipient ON recipient.recipient_id=recipient_appointment.recipient_id WHERE (recipient.process_status='SUCCESS' OR recipient.process_status='REJECTED') AND recipient_appointment.doctor_id=?";
   
    public $acceptRAppointmentSql="UPDATE recipient SET process_status='SUCCESS' WHERE recipient_id=?";
    public $rejectRAppointmentSql="UPDATE recipient SET process_status='REJECTED' WHERE recipient_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addRAppointment($data){
        $param_type="si";
        $this->DBObj->update("UPDATE recipient SET process_status=? WHERE recipient_id=?",$param_type,["SCHEDULE",$data['recipient_id']],"S","F");
        $param_type="sss";
        return $this->DBObj->insert($this->addSql,$param_type,[$data['recipient_id'],$data['doctor_id'],$data['ra_date']],"Appointment has been Scheduled.","Operation failed");
    }
    public function updateRAppointment($data){
        $param_type="iisi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"RAppointment has been update.","Operation failed");
    }
    public function deleteRAppointment($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"RAppointment has been deleted.","Operation failed");
    }
    public function selectAllRAppointments(){
        return $this->DBObj->selectAll($this->selectAllSql,"All doctor.","Operation failed");
    }
    public function selectSingleRAppointment($data){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,$data,"Single event","Operation failed");
    }
    public function getAllAppbyDoctorId($doctor_id){
        $param_type="i";
        return $this->DBObj->select($this->getAllAppbyDoctorIdSql,$param_type,[$doctor_id],"Single event","Operation failed");
    }
    public function getAssingedAppbyDoctorId($doctor_id){
        $param_type="i";
        return $this->DBObj->select($this->getAssingedAppbyDoctorIdSql,$param_type,[$doctor_id],"Single event","Operation failed");
    }
    public function getMissingAppbyDoctorId($doctor_id){
        $param_type="i";
        return $this->DBObj->select($this->getMissingAppbyDoctorIdSql,$param_type,[$doctor_id],"Single event","Operation failed");
    }
    public function getDoneAppbyDoctorId($doctor_id){
        $param_type="i";
        return $this->DBObj->select($this->getDoneAppbyDoctorIdSql,$param_type,[$doctor_id],"Single event","Operation failed");
    }
    public function acceptRAppointment($recipient_id){
        $param_type="i";
        return $this->DBObj->update($this->acceptRAppointmentSql,$param_type,[$recipient_id],"Appointment has been accepted.","Operation failed");
    }
    public function rejectRAppointment($recipient_id){
        $param_type="i";
        return $this->DBObj->update($this->rejectRAppointmentSql,$param_type,[$recipient_id],"Appointment has been rejected.","Operation failed");
    }
    public function getAllRecipientDashboardByDoctorId($doctor_id){
        $data=[];
        $data['allAppCount']=count($this->getAllAppbyDoctorId($doctor_id)['data']);
        $data['assignedCount']=count($this->getAssingedAppbyDoctorId($doctor_id)['data']);
        $data['missingCount']=count($this->getMissingAppbyDoctorId($doctor_id)['data']);
        $data['doneCount']=count($this->getDoneAppbyDoctorId($doctor_id)['data']);

        return $data;
    }
}

// $eventObj=new Event($DBObj);
// $in=$eventObj->selectSingleEvent([3]);
// var_dump($in);
?>