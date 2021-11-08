<?php
$allDoctorData=$doctorObj->selectAllDoctors()['data'];
?>
<div class="table table-responsive">
    <h4 class="text-center mb-3 text-success mt-2">Doctor List </h4>
    <a href="?pageflag=adddoctor" class="s-btn">New</a><br><br>
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
                $count=0;
                foreach($allDoctorData as $doctorData){
            ?>
            <tr>
                <td><?php echo ++$count ; ?></td>
                <td><?php echo $doctorData['doctor_name'] ; ?></td>
                <td><?php echo $doctorData['doctor_email'] ; ?></td>
                <td><?php echo $doctorData['doctor_contactno'] ; ?></td>
                <td><?php echo $doctorData['doctor_qualification'] ; ?></td>
                <td><?php echo $doctorData['organization_name'] ; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>