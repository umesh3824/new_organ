<?php
if(isset($_POST['login'])){
    $userData=[
        test_input($_POST['email']),
        test_input($_POST['password']),
    ];
    
   if($_POST['userRole']=="ADMIN"){
        $data=$adminObj->login($userData);
        if($data['status']==TRUE){
            $url="admin";
            $_SESSION['userid']=$data['data'][0]['admin_id'];
            $_SESSION['userRole']="ADMIN";
            $_SESSION['email']=$data['data'][0]['admin_email'];
            $_SESSION['name']=$data['data'][0]['admin_name'];
            $_SESSION['contactno']=$data['data'][0]['admin_contact'];
        }
   }else if($_POST['userRole']=="DOCTOR"){
        $data=$doctorObj->login($userData);
        if($data['status']==TRUE){
            $url="doctor";
            $_SESSION['userid']=$data['data'][0]['doctor_id'];
            $_SESSION['userRole']="DOCTOR";
            $_SESSION['email']=$data['data'][0]['doctor_email'];
            $_SESSION['name']=$data['data'][0]['doctor_name'];
            $_SESSION['contactno']=$data['data'][0]['doctor_contactno'];
        }
   }
    $donarObj->showAlert($data['message']);
    if($data['status']==TRUE){
        header("location:template/".$url."/home.php");
    }
}
?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Login</h5>
            <form action="?pageflag=admin" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="mt-2"><input type="radio" checked name="userRole" value="ADMIN"> Admin  &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="userRole" value="DOCTOR"> Doctor</div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="login">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>