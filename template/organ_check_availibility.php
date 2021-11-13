<?php

if(isset($_POST['search'])){
    $data=$oragnObj->searchOrgan($_POST['organ_id']);
    // $oragnObj->showAlert($data['message']);
}
if(!isset($_POST['organ_id'])){
    $organ_id=" ";
}else{
    $organ_id=$_POST['organ_id'];
}

$organData=$oragnObj->selectAllOrgans()['data'];
?>
<div class="mb-5 mt-2">
    <div class="row justify-content-center">
        <div class="col-8">
        <h5 class="text-center text-success">Search Organ</h5>
            <form action="?pageflag=organcheckavailibility" method="post">
                <div class="form-group">
                    <label for="address">Select Organ Name</label>
                    <select class="form-control" name="organ_id">
                        <?php foreach($organData as $organ){ ?>
                            <option value="<?php echo $organ['organ_id']; ?>" <?php echo cmpData($organ['organ_id'],$organ_id); ?>><?php echo $organ['organ_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="search">Search</button>
                </div>
            </form>
            <?php if(isset($data)){?>
            <div class="mt-5 bg-light border border-<?php echo $data['status']==TRUE?"success":"danger";?> p-5">
                <h5 class="text-<?php echo $data['status']==TRUE?"success":"danger";?> text-center"><?php echo $data['message'];?></h5>
                <?php if($data['status']==TRUE){ ?>
                     <h5 class="text-success">Organ Name: <?php echo $data['data'][0]['organ_name'];?></h5>
                     <h5 class="text-success">Organ ID: <?php echo $data['data'][0]['ot_id'];?></h5>
               <?php } ?>
            </div>
            <?php }?>
        </div>
    </div>
</div>