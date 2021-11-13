<?php
if(!isset($_POST['appointment_status'])) $status="ALL";
else $status=$_POST['appointment_status']; 

if($status=="ALL"){
    $allDonarData = $DAppointmentObj->getAllAppbyDoctorId($_SESSION['userid'])['data'];
} elseif($status=="ASSIGNED"){
    $allDonarData = $DAppointmentObj->getAssingedAppbyDoctorId($_SESSION['userid'])['data'];
}
elseif($status=="MISSING"){
    $allDonarData = $DAppointmentObj->getMissingAppbyDoctorId($_SESSION['userid'])['data'];
}elseif($status=="DONE"){
    $allDonarData = $DAppointmentObj->getDoneAppbyDoctorId($_SESSION['userid'])['data'];
}
$ddata=$DAppointmentObj->getAllDonarDashboardByDoctorId($_SESSION['userid']);
?>
<div>
    <div>
        <span class="badge bg-secondary">Total: <?php echo $ddata['allAppCount']; ?></span>
        <span class="badge bg-warning">Assigned: <?php echo $ddata['assignedCount']; ?></span>
        <span class="badge bg-danger">Missing: <?php echo $ddata['missingCount']; ?></span>
        <span class="badge bg-success">Done: <?php echo $ddata['doneCount']; ?></span>

    </div>
    <h4 class="text-center mb-3 text-success mt-2">Donar Appointments</h4>
    <div class="d-flex justify-content-between mt-0 pt-0">
        <form action="?pageflag=donarappointments" id="myform" method="post">
            <select name="appointment_status" class="bg-success text-white rounded" onchange="document.getElementById('myform').submit()">
                <option value="ALL" <?php echo cmpData($status,"ALL"); ?>>ALL</option>
                <option value="ASSIGNED" <?php echo cmpData($status,"ASSIGNED"); ?>> Assigned</option>
                <option value="MISSING" <?php echo cmpData($status,"MISSING"); ?>> Missing</option>
                <option value="DONE" <?php echo cmpData($status,"DONE"); ?>> Done</option>
            </select>
        </form>
    </div>
    <div class="table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Contact No</th>
                    <th>DOB</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                foreach ($allDonarData as $donarData) {
                   $colorData=getColor($donarData);
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td> <?php echo $donarData['donar_name']; ?> </td>
                        <td><?php echo $donarData['donar_email']; ?></td>
                        <td><?php echo $donarData['donar_contactno']; ?></td>
                        <td><?php echo $donarData['donar_dob']; ?></td>
                        <td>
                            <span class="badge bg-<?php echo $colorData['color']; ?>"><?php echo $colorData['text']; ?></span>
                            <a href="?pageflag=viewdonar&aid=<?php echo $donarData['da_id']; ?>" class="link-icon text-success"><i class="fas fa-user-edit"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php

function getColor($donarData){
    // return strtotime($donarData['da_date'])<=time();
    if($donarData['process_status']=='SUCCESS' || $donarData['process_status']=='REJECTED'){
        $returnData['color']="success";
        $returnData['text']="Done";
    }elseif($donarData['process_status']=='SCHEDULE' && strtotime($donarData['da_date'])<time()){
        $returnData['color']="danger";
        $returnData['text']="Missing";
    }elseif($donarData['process_status']=='SCHEDULE' && strtotime($donarData['da_date'])>=time()){
        $returnData['color']="warning";
        $returnData['text']="Assigned";
    }
    return $returnData;
}
?>