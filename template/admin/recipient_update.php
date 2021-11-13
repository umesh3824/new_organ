<?php

if(isset($_POST['update_recipient'])){
    $userData=[
        test_input($_POST['name']),
        test_input($_POST['email']),
        test_input($_POST['contactno']),
        test_input($_POST['dob']),
        test_input($_POST['address']),
        test_input($_GET['did'])
    ];
    $data=$recipientObj->updateRecipient($userData);
    $recipientObj->showAlert($data['message']);
}


$recipientData=$recipientObj->selectSingleRecipient([test_input($_GET['did'])])['data'][0];
?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Update Recipient</h5>
            <form action="" method="post" id="form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="<?php echo $recipientData['recipient_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?php echo $recipientData['recipient_email']; ?>">
                </div>
                <div class="form-group">
                    <label for="contactno">Contact No</label>
                    <input type="text" class="form-control" name="contactno" placeholder="Enter contact no" required value="<?php echo $recipientData['recipient_contactno']; ?>"> 
                </div>
                <div class="form-group">
                    <label for="dob">select DOB</label>
                    <input type="date" class="form-control" name="dob" required value="<?php echo $recipientData['recipient_dob']; ?>">
                </div>                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter address here"><?php echo $recipientData['recipient_address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Organ Name</label>
                    <input type="text" class="form-control"required value="<?php echo $recipientData['organ_name']; ?>"  disabled>
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="update_recipient">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>