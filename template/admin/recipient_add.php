<?php

if(isset($_POST['add_recipient'])){
    $indata=$oragnObj->getOrganIdByOTId($_POST['ot_id']);
    $userData=[
        test_input($_POST['name']),
        test_input($_POST['email']),
        test_input($_POST['contactno']),
        test_input($_POST['dob']),
        test_input($_POST['address']),
        $indata['data'][0]['organ_id']
    ];
    $data=$recipientObj->addRecipient($userData,test_input($_POST['ot_id']));
    $recipientObj->showAlert($data['message']);
}


$organData=$oragnObj->selectAllOrgans()['data'];
?>
<div class="p-5">
    <div class="row justify-content-center">
        <div class="col-8 p-5 border">
        <h5 class="text-center mb-3 text-success">Recipient Application Form</h5>
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
                    <label for="address">Enter Organ ID</label>
                    <input type="text" class="form-control" name="ot_id" placeholder="Enter Organ ID">
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success" name="add_recipient">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>