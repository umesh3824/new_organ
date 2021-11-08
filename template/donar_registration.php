<?php

if(isset($_POST['add_donar'])){
    if(test_input($_POST['password'])==test_input($_POST['confirm_password'])){
        $userData=[
            test_input($_POST['name']),
            test_input($_POST['email']),
            test_input($_POST['contactno']),
            test_input($_POST['dob']),
            test_input($_POST['address']),
            test_input($_POST['password'])
        ];
        $data=$donarObj->addDonar($userData);
    }
    else{
        $data['message']="Confirm password not matched with password.";
    }
    $donarObj->showAlert($data['message']);
}



?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Donar Registraion</h5>
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
                    <label for="dob">select DOB</label>
                    <input type="date" class="form-control" name="dob" required>
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
                    <button type="submit" class="btn btn-success" name="add_donar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>