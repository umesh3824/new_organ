<?php
if (isset($_GET['did'])) {
    $data = $recipientObj->deleteRecipient([test_input($_GET['did'])]);
    $recipientObj->showAlert($data['message']);
}
if(!isset($_POST['process_status'])) $status="ALL";
else $status=$_POST['process_status']; 
$allRecipientData = $recipientObj->selectAllRecipientsByStatus($status)['data'];
?>
<div>
    <h4 class="text-center mb-3 text-success mt-2">Recipient List </h4>
    <div class="d-flex justify-content-between mt-0 pt-0">
        <form action="?pageflag=arecipientlist" id="myform" method="post">
            <select name="process_status" class="bg-success text-white rounded" onchange="document.getElementById('myform').submit()">
                <option value="ALL" <?php echo cmpData($status,"ALL"); ?>>ALL</option>
                <option value="PENDING" <?php echo cmpData($status,"PENDING"); ?>> PENDING</option>
                <option value="SCHEDULE" <?php echo cmpData($status,"SCHEDULE"); ?>> SCHEDULE</option>
                <option value="SUCCESS" <?php echo cmpData($status,"SUCCESS"); ?>> SUCCESS</option>
                <option value="REJECTED" <?php echo cmpData($status,"REJECTED"); ?>> REJECTED</option>
            </select>
        </form>
        <a href="?pageflag=addrecipient" class="s-btn"><i class="fas fa-user-plus"></i> New</a>
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
                foreach ($allRecipientData as $recipientData) {
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $recipientData['recipient_name']; ?></td>
                        <td><?php echo $recipientData['recipient_email']; ?></td>
                        <td><?php echo $recipientData['recipient_contactno']; ?></td>
                        <td><?php echo $recipientData['recipient_dob']; ?></td>
                        <td>
                        <span class="badge bg-<?php echo getColor($recipientData['process_status']); ?>"><?php echo ucfirst(strtolower($recipientData['process_status'])); ?></span>
                            <a href="?pageflag=updaterecipient&did=<?php echo $recipientData['recipient_id']; ?>" class="link-icon text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="?pageflag=arecipientlist&did=<?php echo $recipientData['recipient_id']; ?>" class="link-icon text-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
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