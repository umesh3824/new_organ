<?php

if(isset($_POST['update_doctor'])){
    if(test_input($_POST['password'])==test_input($_POST['confirm_password'])){
        $userData=[
            test_input($_POST['name']),
            test_input($_POST['email']),
            test_input($_POST['contactno']),
            test_input($_POST['password']),
            test_input($_POST['qualification']),
            test_input($_POST['organization_name']),
            test_input($_POST['address']),
            test_input($_GET['did'])
        ];
        $data=$doctorObj->UpdateDoctor($userData);
    }
    else{
        $data['message']="Confirm password not matched with password.";
    }
    $doctorObj->showAlert($data['message']);
}

$doctorData=$doctorObj->selectSingleDoctor([test_input($_GET['did'])])['data'][0];
?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Update Doctor</h5>
            <form action="" method="post" id="form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="<?php echo $doctorData['doctor_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?php echo $doctorData['doctor_email']; ?>">
                </div>
                <div class="form-group">
                    <label for="contactno">Contact No</label>
                    <input type="text" class="form-control" name="contactno" placeholder="Enter contact no" required value="<?php echo $doctorData['doctor_contactno']; ?>">
                </div>
                <div class="form-group">
                    <label for="qualification">Qualification</label>
                    <input type="text" class="form-control" name="qualification" placeholder="Enter qualification" required value="<?php echo $doctorData['doctor_qualification']; ?>">
                </div>
                <div class="form-group">
                    <label for="organization_name">Organization Name</label>
                    <input type="text" class="form-control" name="organization_name" placeholder="Enter organization name" required value="<?php echo $doctorData['organization_name']; ?>">
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter address here"> <?php echo $doctorData['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required  value="<?php echo $doctorData['doctor_password']; ?>">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Password" required value="<?php echo $doctorData['doctor_password']; ?>">
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="update_doctor">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>