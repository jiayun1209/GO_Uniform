<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {

        mysqli_query($con, "update orders set paymentMethod='".$_POST['paymentMethod'] . "', cardnumber='" . $_POST['cardNum'] . "', expirydate='" . $_POST['expirydate'] . "', cvNumber='" . $_POST['cvNum'] . "' where userId='" . $_SESSION['id'] . "' and paymentMethod is null ");

        unset($_SESSION['cart']);
        header('location:order-history.php');
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
                                                   
                                                    <input type="radio" name="paymentMethod" <?php if (isset($paymentMethod) && $paymentMethod == "credit card") echo "checked"; ?> value="credit card" required="required" />  Credit Card &nbsp; &nbsp; &nbsp; &nbsp;      
                                                    <input type="radio" name="paymentMethod" <?php if (isset($paymentMethod) && $paymentMethod == "debit") echo "checked"; ?> value="debit"required="required" />  Debit
 <br> <br>
                                                    <label for="cardNumber">
                                                        CARD NUMBER</label>

                                                    <input type="text=" name="cardNum" class="form-control unicase-form-control text-input " id="exampleInputcardnum" placeholder="Valid Card Number" required/ >
                                                    <br>
                                                    <label for="expiryDate">
                                                        EXPIRY DATE</label>

                                                    <input type="text" name="expirydate" class="form-control unicase-form-control text-input" id="exampleInputexpirydate" placeholder="YYYY/MM/DD" required/> 
                                                    <br>
                                                    <label for="cvCode">
                                                        CVV CODE</label>

                                                    <input type="text" name="cvNum" class="form-control unicase-form-control text-input" id="exampleInputcvNum" placeholder="CVV CODE" required/> 
                                                    <br><br>

                                                    <input type="submit" value="submit" name="submit" class="btn btn-primary">
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>		
                    </div>
                    <!-- panel-body  -->

                </div><!-- row -->
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
<?php } ?>