
<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code contact us
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $query = mysqli_query($con, "insert into contact_us (name,email,message) values('$name','$email','$message')");
    if ($query) {
        echo "<script>alert('You are successfully send message, Thank you for contacting us, we will get back to you soon...');</script>";
    } else {
        echo "<script>alert('Message went wrong, Please try again!');</script>";
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
        <title>Contact Us</title>
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

            <h1 class="w3-wide w3-center">C O N T A C T</h1>

            <p><strong>KEEP IN TOUCH WITH US</strong></p>
            <p>We would love to hear from you!</p>
            <p>Have a question? Don't know what to choose? Need a quote for bulk orders? 
                Surprising someone special? Need a shirt's RIGHT NOW?!</p>
            <br>

            <p><strong>Here are some FAQs</strong></p>
            <p><strong>Why buy with us?</strong></p>
            <p>All our cloth are comfortable with reasonable price, 
                unless need provide special service otherwise the price are fixed.</p>

            <br>

            <p><strong>How many slices/wedges are there in a cake?</strong></p>
            <p>It really depends on the size of the cake, but as a rule of thumb we cut them by 12. 
                You could also cut it anyway you like… go nuts! But really, who eats a cake one slice at a time!</p>

            <br>
            <p class="w3-opacity"><i>Drop a note for our promotion's</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i> Puchong, Selangor<br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: +6 019 3392862<br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: myHomeJellyCake@gmail.com<br>
                </div>
                <div class="w3-col m6">
                

                        <form class="register-form outer-top-xs" role="form" method="post" name="register">
                            <div class="form-group">
                                <label class="info-title" for="name">Full Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" required="required">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="email">Email <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="email" name="email" required="required">
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="message">Message <span>*</span></label>
                                <input type="message" class="form-control unicase-form-control text-input" id="message" name="message" required >
                               
                            </div>
                            <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Submit</button>

                            
                        </form>


                </div>
            </div>
        </div>

    </div>


</body>
<?php include('includes/footer.php'); ?>
</html>
