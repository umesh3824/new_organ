<?php
if (isset($_GET['did'])) {
    $data = $donarObj->deleteDonar([test_input($_GET['did'])]);
    $donarObj->showAlert($data['message']);
}
$allDonarData = $donarObj->selectAllDonars()['data'];
?>
<div>
    <h4 class="text-center mb-3 text-success mt-2">Donar List </h4>
    <div class="d-flex justify-content-between mt-0 pt-0"><span></span><a href="?pageflag=adddonar" class="s-btn"><i class="fas fa-user-plus"></i> New</a></div>
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
                        <td><?php echo $donarData['donar_name']; ?></td>
                        <td><?php echo $donarData['donar_email']; ?></td>
                        <td><?php echo $donarData['donar_contactno']; ?></td>
                        <td><?php echo $donarData['donar_dob']; ?></td>
                        <td>
                            <a href="?pageflag=updatedonar&did=<?php echo $donarData['donar_id']; ?>" class="link-icon text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="?pageflag=adonarlist&did=<?php echo $donarData['donar_id']; ?>" class="link-icon text-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>