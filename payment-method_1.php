<?php
session_start();
error_reporting(0);
include('includes/config.php');

// code for Shipping address  + payment method updation
if (isset($_POST['guestaddress'])) {
    $shippingAddress = $_POST['shippingAddress'];
    $shippingState = $_POST['shippingState'];
    $shippingCity = $_POST['shippingCity'];
    $shippingPincode = $_POST['shippingPincode'];
    $paymentMethod = $_POST['paymentMethod'];
    $cardnumber = $_POST['cardnumber'];
    $expirydate = $_POST['expirydate'];
    $cvNumber = $_POST['cvNumber'];

    $query = mysqli_query($con, "insert into guestaddress (shippingAddress, shippingState,"
            . "shippingCity, shippingPincode, paymentMethod, cardnumber, expirydate, cvNumber) values ('$shippingAddress','$shippingState','$shippingCity','$shippingPincode', "
            . "'$paymentMethod', '$cardnumber', '$expirydate', '$cvNumber')");
    if ($query) {
        echo "<script>alert('Shipping Address + Payment Method has been updated');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">

        <title>Payment Method</title>
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

        <!-- Bootstrap and Font Awesome css -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <!-- Css animations  -->
        <link href="css/animate.css" rel="stylesheet">

        <!-- Theme stylesheet, if possible do not edit this stylesheet -->
        <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

        <!-- Custom stylesheet - for your changes -->
        <link href="css/custom.css" rel="stylesheet"> 

    </head>
    <body class="cnt-home">


        <header class="header-style-1">
            <?php include('includes/top-header.php'); ?>
            <br><br>   <br><br>
            <?php include('includes/main-header.php'); ?>
            <?php include('includes/menu-bar.php'); ?>
        </header>


        <div class="body-content outer-top-bd">
            <div class="container">
                <div class="checkout-box faq-page inner-bottom-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Shipping Address</h2>
                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">

                                    <div id="collapseOne" class="panel-collapse collapse in">

                                        <div class="panel-body">

                                            <form class="register-form" role="form" method="post">
                                                <div class="form-group">
                                                    <label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
                                                    <textarea class="form-control unicase-form-control text-input" " name="shippingAddress" required="required"><?php echo $row['shippingAddress']; ?></textarea>
                                                </div>



                                                <div class="form-group">
                                                    <label class="info-title" for="Shipping State ">Shipping State  <span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" id="shippingState" name="shippingState" value="<?php echo $row['shippingState']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="Shipping City">Shipping City <span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" id="shippingCity" name="shippingCity" required="required" value="<?php echo $row['shippingCity']; ?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="Shipping Pincode">Shipping Pincode <span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" id="shippingPincode" name="shippingPincode" required="required" value="<?php echo $row['shippingPincode']; ?>" >
                                                </div>


                                                                <h2>Choose Payment Method</h2>
                                                                <div class="panel-group checkout-steps" id="accordion">
                                                                    <!-- checkout-step-01  -->
                                                                    <div class="panel panel-default checkout-step-01">

                                                                        <!-- panel-heading -->
                                                                        <div class="panel-heading">
                                                                            <h4 class="unicase-checkout-title">
                                                                                Select your Payment Method (Credit Card / Debit)
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <!-- panel-heading -->

                                                                        <div id="collapseOne" class="panel-collapse collapse in">

                                                                            <div class="panel-body">

                                                                                <label for="cardNumber">PAYMENT METHOD</label>

                                                                                <form method="post">
                                    <!--                                                        <input type="radio" name="paymentMethod" value="Credit card">Credit card
                                                                                     <input type="radio" name="paymentMethod" value="Debit"> Debit 
                                                                                     <br><br>-->

                                                                                    <input type="radio" name="paymentMethod"  value="credit card" required="required" />  Credit Card &nbsp; &nbsp; &nbsp; &nbsp;      
                                                                                    <input type="radio" name="paymentMethod"  value="debit"required="required" />  Debit
                                                                                    <br> <br>
                                                                                    <div class="form-group">
                                                                                        <label class="info-title" for="cardnumber">Card Number  <span>*</span></label>
                                                                                        <input type="text" class="form-control unicase-form-control text-input" id="cardnumber" name="cardnumber" required="required" value="<?php echo $row['cardnumber']; ?>" >
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                       <label class="info-title" for="expirydate">Expiry Date  <span>*</span></label>
                                                                                        <input type="text" class="form-control unicase-form-control text-input" id="expirydate" name="expirydate" required="required" value="<?php echo $row['expirydate']; ?>" >
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="info-title" for="cvNumber">CVV Number  <span>*</span></label>
                                                                                        <input type="text" class="form-control unicase-form-control text-input" id="cvNumber" name="cvNumber" required="required" value="<?php echo $row['cvNumber']; ?>" >
                                                                                    </div>

                                                                                </form>
                                   
                                                    <button type="submit" name="guestaddress" class="btn-upper btn btn-primary checkout-page-button">Submit</button>
                                            </form>




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- checkout-step-01  -->


                </div><!-- /.checkout-steps -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.checkout-box -->
</div><!-- /.body-content -->
<?php include('includes/footer.php'); ?>
<script src="assets/js/jquery-1.11.1.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/js/echo.min.js"></script>
<script src="assets/js/jquery.easing-1.3.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- For demo purposes â€“ can be removed on production -->

<script src="switchstylesheet/switchstylesheet.js"></script>

<script>
    $(document).ready(function () {
        $(".changecolor").switchstylesheet({seperator: "color"});
        $('.show-theme-options').click(function () {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function () {
        $('.show-theme-options').delay(2000).trigger('click');
    });

</script>

</body>
</html>
