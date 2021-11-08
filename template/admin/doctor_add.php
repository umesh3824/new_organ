<?php

if(isset($_POST['add_doctor'])){
    if(test_input($_POST['password'])==test_input($_POST['confirm_password'])){
        $userData=[
            test_input($_POST['name']),
            test_input($_POST['email']),
            test_input($_POST['contactno']),
            test_input($_POST['password']),
            test_input($_POST['qualification']),
            test_input($_POST['organization_name']),
            test_input($_POST['address'])
        ];
        $data=$doctorObj->addDoctor($userData);
    }
    else{
        $data['message']="Confirm password not matched with password.";
    }
    $doctorObj->showAlert($data['message']);
}



?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Add Doctor</h5>
            <form action="" method="post" id="form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required >
                </div>
                <div class="form-group">
                    <label for="contactno">Contact No</label>
                    <input type="text" class="form-control" name="contactno" placeholder="Enter contact no" required>
                </div>
                <div class="form-group">
                    <label for="qualification">Qualification</label>
                    <input type="text" class="form-control" name="qualification" placeholder="Enter qualification" required>
                </div>
                <div class="form-group">
                    <label for="organization_name">Organization Name</label>
                    <input type="text" class="form-control" name="organization_name" placeholder="Enter organization name" required>
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter address here"></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Password" required>
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="add_doctor">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>