<?php

if(isset($_POST['update_donar'])){
    if(test_input($_POST['password'])==test_input($_POST['confirm_password'])){
        $userData=[
            test_input($_POST['name']),
            test_input($_POST['email']),
            test_input($_POST['contactno']),
            test_input($_POST['dob']),
            test_input($_POST['address']),
            test_input($_POST['password']),
            test_input($_GET['did'])
        ];
        $data=$donarObj->updateDonar($userData);
    }
    else{
        $data['message']="Confirm password not matched with password.";
    }
    $donarObj->showAlert($data['message']);
}


$donarData=$donarObj->selectSingleDonar([test_input($_GET['did'])])['data'][0];
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
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required value="<?php echo $donarData['donar_password']; ?>">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Password" required value="<?php echo $donarData['donar_password']; ?>">
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="update_donar">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>