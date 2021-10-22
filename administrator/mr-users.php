<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code Material Requisition key in by users - clients
if (isset($_POST['submit'])) {
    $staff_id = $_POST['staff_id'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    
    $query = mysqli_query($con, "insert into mr (staff_id, description, type, status) values('$staff_id','$description', '$type', '$status')");
    if ($query) {
        echo "<script>alert('Material Requisition Created.');</script>";
    } else {
        echo "<script>alert('Material Requisition went wrong, Please try again!');</script>";
    }
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Material Requisition</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
	
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">

		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
                <link rel="shortcut icon" href="img/logo.jpg">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <?php include('includes/top-header_1.php'); ?>

    <body><br><br>


        <!-- The Contact Section -->
        <div class="container"> 

            <h1 class="w3-wide w3-center">Material Requisition</h1>

            <p class="w3-opacity"><i>Create Material Requisition</i></p>
         
             

                        <form class="register-form outer-top-xs" role="form" method="post" name="register">
                          

                            <div class="form-group">
                                <label class="info-title" for="staff_id">Staff ID <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="staff_id" name="staff_id" required="required">
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="description">Description <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="description" name="description" required="required">
                               
                            </div>
                            
                            <div class="form-group">
                                <label class="info-title" for="type">Type <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="type" name="type" required="required">
                               
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="info-title" for="status">Status <span></span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="status" name="status">
                               
                            </div>
                            
                            <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Create</button>

                            
                        </form>

            </div>
        </div>

    </div>


</body>
<?php include('includes/footer.php'); ?>
</html>

