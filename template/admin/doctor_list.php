<?php
if (isset($_GET['did'])) {
    $data = $doctorObj->deleteDoctor([test_input($_GET['did'])]);
    $doctorObj->showAlert($data['message']);
}
$allDoctorData = $doctorObj->selectAllDoctors()['data'];
?>
<div>
    <h4 class="text-center mb-3 text-success mt-2">Doctor List </h4>
    <div class="d-flex justify-content-between mt-0 pt-0"><span></span><a href="?pageflag=adddoctor" class="s-btn"><i class="fas fa-user-plus"></i> New</a></div>
    <div class="table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Contact No</th>
                    <th>Qulification</th>
                    <th>Organization</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                foreach ($allDoctorData as $doctorData) {
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $doctorData['doctor_name']; ?></td>
                        <td><?php echo $doctorData['doctor_email']; ?></td>
                        <td><?php echo $doctorData['doctor_contactno']; ?></td>
                        <td><?php echo $doctorData['doctor_qualification']; ?></td>
                        <td><?php echo $doctorData['organization_name']; ?></td>
                        <td>
                            <a href="?pageflag=updatedoctor&did=<?php echo $doctorData['doctor_id']; ?>" class="link-icon text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="?pageflag=doctorlist&did=<?php echo $doctorData['doctor_id']; ?>" class="link-icon text-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>