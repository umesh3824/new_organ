<?php
class DAppointment extends Record{
    public $DBObj;
    public $addSql="INSERT INTO donar_appointment(donar_id,doctor_id,da_date) VALUES (?,?,?)";
    public $updateSql="UPDATE donar_appointment SET donar_id=?,doctor_id=?,da_date=? WHERE da_id=?";
    public $deleteSql="DELETE FROM donar_appointment WHERE da_id=?";
    public $selectAllSql="SELECT * FROM donar_appointment";
    public $selectSingleSql="SELECT * FROM donar_appointment INNER JOIN donar ON donar.donar_id=donar_appointment.donar_id INNER JOIN organ ON donar.organ_id=organ.organ_id WHERE donar_appointment.da_id=?";

    public $getAllAppbyDoctorIdSql="SELECT * FROM donar_appointment INNER JOIN donar ON donar.donar_id=donar_appointment.donar_id WHERE  donar_appointment.doctor_id=?";
    public $getAssingedAppbyDoctorIdSql="SELECT * FROM donar_appointment INNER JOIN donar ON donar.donar_id=donar_appointment.donar_id WHERE donar.process_status='SCHEDULE' AND donar_appointment.da_date>=now() AND donar_appointment.doctor_id=?";
    public $getMissingAppbyDoctorIdSql="SELECT * FROM donar_appointment INNER JOIN donar ON donar.donar_id=donar_appointment.donar_id WHERE donar.process_status='SCHEDULE' AND donar_appointment.da_date<now() AND donar_appointment.doctor_id=?";
    public $getDoneAppbyDoctorIdSql="SELECT * FROM donar_appointment INNER JOIN donar ON donar.donar_id=donar_appointment.donar_id WHERE (donar.process_status='SUCCESS' OR donar.process_status='REJECTED') AND donar_appointment.doctor_id=?";
   
    public $acceptDAppointmentSql="UPDATE donar SET process_status='SUCCESS' WHERE donar_id=?";
    public $rejectDAppointmentSql="UPDATE donar SET process_status='REJECTED' WHERE donar_id=?";
  
    function __construct($DBObj){
        $this->DBObj=$DBObj;
    }
    public function addDAppointment($data){
        $param_type="si";
        $this->DBObj->update("UPDATE donar SET process_status=? WHERE donar_id=?",$param_type,["SCHEDULE",$data['donar_id']],"S","F");
        $param_type="sss";
        return $this->DBObj->insert($this->addSql,$param_type,[$data['donar_id'],$data['doctor_id'],$data['da_date']],"Appointment has been Scheduled.","Operation failed");
    }
    public function updateDAppointment($data){
        $param_type="iisi";
        return $this->DBObj->update($this->updateSql,$param_type,$data,"DAppointment has been update.","Operation failed");
    }
    public function deleteDAppointment($data){
        $param_type="i";
        return $this->DBObj->delete($this->deleteSql,$param_type,$data,"DAppointment has been deleted.","Operation failed");
    }
    public function selectAllDAppointments(){
        return $this->DBObj->selectAll($this->selectAllSql,"All doctor.","Operation failed");
    }
    public function selectSingleDAppointment($da_id){
        $param_type="i";
        return $this->DBObj->select($this->selectSingleSql,$param_type,[$da_id],"Single event","Operation failed");
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
    public function acceptDAppointment($donar_id){
        $param_type="i";
        $indata=$this->DBObj->update($this->acceptDAppointmentSql,$param_type,[$donar_id],"Appointment has been accepted.","Operation failed");
        $param_type="i";
        if($indata['status']==TRUE){
            $this->DBObj->insert("INSERT INTO organ_transaction(donar_id) VALUES (?)",$param_type,[$donar_id],"S","F");
        }
        return $indata;
    }
    public function rejectDAppointment($donar_id){
        $param_type="i";
        return $this->DBObj->update($this->rejectDAppointmentSql,$param_type,[$donar_id],"Appointment has been rejected.","Operation failed");
    }
    public function getAllDonarDashboardByDoctorId($doctor_id){
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