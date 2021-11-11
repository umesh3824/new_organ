<?php

if(isset($_POST['update_donar'])){
    $userData=[
        test_input($_POST['name']),
        test_input($_POST['email']),
        test_input($_POST['contactno']),
        test_input($_POST['dob']),
        test_input($_POST['address']),
        test_input($_POST['organ']),
        test_input($_GET['did'])
    ];
    $data=$donarObj->updateDonar($userData);
    $donarObj->showAlert($data['message']);
}


$donarData=$donarObj->selectSingleDonar([test_input($_GET['did'])])['data'][0];
$organData=$oragnObj->selectAllOrgans()['data'];
?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Update Donar</h5>
            <form action="" method="post" id="form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="<?php echo $donarData['donar_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?php echo $donarData['donar_email']; ?>">
                </div>
                <div class="form-group">
                    <label for="contactno">Contact No</label>
                    <input type="text" class="form-control" name="contactno" placeholder="Enter contact no" required value="<?php echo $donarData['donar_contactno']; ?>"> 
                </div>
                <div class="form-group">
                    <label for="dob">select DOB</label>
                    <input type="date" class="form-control" name="dob" required value="<?php echo $donarData['donar_dob']; ?>">
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter address here"><?php echo $donarData['donar_address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Which Organ Do you want to donate?</label>
                    <select class="form-control" name="organ">
                        <?php foreach($organData as $organ){ var_dump($donarData); ?>
                            <option value="<?php echo $organ['organ_id']; ?>" <?php echo cmpData($organ['organ_id'],$donarData['organ_id']); ?>><?php echo $organ['organ_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="update_donar">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>