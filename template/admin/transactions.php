<?php
$allData = $organTransactionObj->selectAllOT()['data'];
?>
<div>
    <h4 class="text-center mb-3 text-success mt-2">Transaction List </h4>
    <div class="table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Organ Name</th>
                    <th>Donar Name</th>
                    <th>Donar Email</th>
                    <th>Recipient Name</th>
                    <th>Recipient Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                foreach ($allData as $Tdata) {
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $Tdata['organ_name']; ?></td>
                        <td><?php echo $Tdata['donar_name']; ?></td>
                        <td><?php echo $Tdata['donar_email']; ?></td>
                        <td><?php echo $Tdata['recipient_name']; ?></td>
                        <td><?php echo $Tdata['recipient_email']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>