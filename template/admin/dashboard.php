<?php

$organData=$oragnObj->selectAllOrgans()['data'];
?>
<div class="p-3">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3 text-success">Dashboard</h5>
            <div class="text-dark d-flex justify-content-around p-2">
                <span class="badge bg-warning p-2">Donar: <?php echo count($donarObj->selectAllDonarsByStatus("ALL")['data']); ?> </span>
                <span class="badge bg-success p-2">Recipient: <?php echo count($recipientObj->selectAllRecipientsByStatus("ALL")['data'])-1; ?></span>
                <span class="badge bg-secondary p-2">Doctor: <?php echo count($doctorObj->selectAllDoctors()['data']); ?></span>
            </div>
            <hr>
            <div class="table-responsive bg-light p-2">
                <h5 class="text-center">Available Organ</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Organ Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count=0;
                            foreach($organData as $organ){ 
                        ?>
                        <tr>
                            <td><?php echo ++$count; ?></td>
                            <th><?php echo $organ['organ_name']; ?></th>
                            <td><?php echo count($oragnObj->searchOrgan($organ['organ_id'])['data']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>