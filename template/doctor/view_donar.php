<?php
  
if(isset($_POST['donate'])){
    $data=$DAppointmentObj->acceptDAppointment($_POST['donar_id']);
    $DAppointmentObj->showAlert($data['message']);
}
if(isset($_POST['reject'])){
    $data=$DAppointmentObj->rejectDAppointment($_POST['donar_id']);
    $DAppointmentObj->showAlert($data['message']);
}
$userData=$DAppointmentObj->selectSingleDAppointment($_GET['aid'])['data'][0];
?>
<div class="row">
    <h4 class="text-center mb-3 text-success mt-2">Donar Appointment Details</h4>
    <div class="col-sm"></div>
    <div class="table-responsive justify-content-center col-sm">
        <table class="table table-borderless table-info rounded mt-3 mb-3">
            <tbody>
                <tr>
                    <th scope="row">Name:</th>
                    <td><?php echo $userData['donar_name']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td><?php echo $userData['donar_email']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Contact No:</th>
                    <td><?php echo $userData['donar_contactno']; ?></td>
                </tr>
                <tr>
                    <th scope="row">DOB:</th>
                    <td><?php echo $userData['donar_dob']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Address:</th>
                    <td><?php echo $userData['donar_address']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Status:</th>
                    <td> <span class="badge bg-<?php echo getColor($userData['process_status']); ?>"><?php echo ucfirst(strtolower($userData['process_status'])); ?></span></td>
                </tr>
                <tr>
                    <th scope="row">Organ Name</th>
                    <td><?php echo $userData['organ_name']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Appointment Date:</th>
                    <td><?php echo $userData['da_date']; ?></td>
                </tr>
                <?php if($userData['process_status']=="SCHEDULE"){ ?>
                <tr>
                    <form action="?pageflag=viewdonar&aid=<?php echo $_GET['aid']; ?>" method="post">
                        <th class="text-center"><input type="submit" value="Donate" name="donate" class="btn btn-sm btn-success"></th>
                        <th class="text-center"><input type="submit" value="Reject" name="reject" class="btn btn-sm btn-danger"></th>
                        <input type="text" style="visibility:hidden;width:0px;height:0px;" name="donar_id" value="<?php echo $userData['donar_id']; ?>">
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm"></div>
</div>
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