<?php
if (isset($_GET['did'])) {
    $data = $donarObj->deleteDonar([test_input($_GET['did'])]);
    $donarObj->showAlert($data['message']);
}
if (isset($_POST['schedule'])) {
    $appData=[
        "donar_id"=>test_input($_POST['donar_id']),
        "doctor_id"=>test_input($_POST['doctor_id']),
        "da_date"=>test_input($_POST['da_date'])];
        
    $data = $DAppointmentObj->addDAppointment($appData);
    if($data['status']){
        $donarData=$donarObj->selectSingleDonar([test_input($_POST['donar_id'])])['data'][0];
        upc_send_mail($donarData['donar_email'],"
                <div style='background-color:#f8f9fa;color:black;padding:10px;border-radius:10px;'>
                    <p>Hello, ".$donarData['donar_name']."<br><br>
                        Your meeting for organ donation is scheduled on ".test_input($_POST['da_date'])." at any near by organ donation center.<hr>
                        If, You have any query feel free to contact on admin@gmail.com
                    </p>
            </div>");
    }
    $DAppointmentObj->showAlert($data['message']);
}
if(!isset($_POST['process_status'])) $status="ALL";
else $status=$_POST['process_status']; 

$allDonarData = $donarObj->selectAllDonarsByStatus($status)['data'];
$allDoctorData=$doctorObj->selectAllDoctors()['data'];
?>
<div>
    <h4 class="text-center mb-3 text-success mt-2">Donar List </h4>
    <div class="d-flex justify-content-between mt-0 pt-0">
        <form action="?pageflag=adonarlist" id="myform" method="post">
            <select name="process_status" class="bg-success text-white rounded" onchange="document.getElementById('myform').submit()">
                <option value="ALL" <?php echo cmpData($status,"ALL"); ?>>ALL</option>
                <option value="PENDING" <?php echo cmpData($status,"PENDING"); ?>> PENDING</option>
                <option value="SCHEDULE" <?php echo cmpData($status,"SCHEDULE"); ?>> SCHEDULE</option>
                <option value="SUCCESS" <?php echo cmpData($status,"SUCCESS"); ?>> SUCCESS</option>
                <option value="REJECTED" <?php echo cmpData($status,"REJECTED"); ?>> REJECTED</option>
            </select>
        </form>
        <a href="?pageflag=adddonar" class="s-btn"><i class="fas fa-user-plus"></i> New</a>
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
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td> <?php echo $donarData['donar_name']; ?> </td>
                        <td><?php echo $donarData['donar_email']; ?></td>
                        <td><?php echo $donarData['donar_contactno']; ?></td>
                        <td><?php echo $donarData['donar_dob']; ?></td>
                        <td>
                            <span class="badge bg-<?php echo getColor($donarData['process_status']); ?>"><?php echo ucfirst(strtolower($donarData['process_status'])); ?></span>
                            <a href="?pageflag=updatedonar&did=<?php echo $donarData['donar_id']; ?>" class="link-icon text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="?pageflag=adonarlist&did=<?php echo $donarData['donar_id']; ?>" class="link-icon text-danger"><i class="fas fa-trash-alt"></i></a>
                            <?php if($donarData['process_status']=="PENDING"){ ?><a href="?pageflag=adonarlist" onClick="setIDData(<?php echo $donarData['donar_id']; ?>)" class="link-icon text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-handshake"></i></a><?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Schedule Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="?pageflag=adonarlist" method="post">
            <div class="form-group">
                <label for="did">Select Doctor</label>
                <select class="form-control" id="did" name="doctor_id" required>
                    <?php foreach($allDoctorData as $doctor) {?>
                    <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['doctor_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Select Date</label>
                <input type="date" class="form-control" name="da_date" required>
            </div>
            <input type="text" style="visibility:hidden;height:0px;" name="donar_id" id="donar_id" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="schedule">Schedule</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    function setIDData(uid){
        document.getElementById('donar_id').value=uid;
    }
</script>

<?php

function getColor($status){
    if($status=='PENDING'){
        return "warning";
    }elseif($status=='SCHEDULE'){
        return "secondary";
    }elseif($status=='REJECTED'){
        return 'danger';
    }elseif($status=='SUCCESS'){
        return 'success';
    }
}
?>