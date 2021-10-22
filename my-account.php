<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $contactno = $_POST['contactno'];
        $query = mysqli_query($con, "update users set name='$name',contactno='$contactno' where id='" . $_SESSION['id'] . "'");
        if ($query) {
            echo "<script>alert('Your profile has been updated');</script>";
        }
    }


    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());


    if (isset($_POST['submit'])) {
        $sql = mysqli_query($con, "SELECT password FROM  users where password='" . md5($_POST['cpass']) . "' && id='" . $_SESSION['id'] . "'");
        $num = mysqli_fetch_array($sql);
        if ($num > 0) {
            $con = mysqli_query($con, "update users set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where id='" . $_SESSION['id'] . "'");
            echo "<script>alert('Password Changed Successfully !!');</script>";
        } else {
            echo "<script>alert('Current Password not match !!');</script>";
        }
    }


// code for Shipping address updation
    if (isset($_POST['updateshippingaddress'])) {
        $saddress = $_POST['shippingaddress'];
        $sstate = $_POST['shippingstate'];
        $scity = $_POST['shippingcity'];
        $spincode = $_POST['shippingpincode'];
        $query = mysqli_query($con, "update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='" . $_SESSION['id'] . "'");
        if ($query) {
            echo "<script>alert('Shipping Address has been updated');</script>";
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

            <title>My Account</title>

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

            <script type="text/javascript">
                function valid()
                {
                    if (document.chngpwd.cpass.value == "")
                    {
                        alert("Current Password Filed is Empty !!");
                        document.chngpwd.cpass.focus();
                        return false;
                    } else if (document.chngpwd.newpass.value == "")
                    {
                        alert("New Password Filed is Empty !!");
                        document.chngpwd.newpass.focus();
                        return false;
                    } else if (document.chngpwd.cnfpass.value == "")
                    {
                        alert("Confirm Password Filed is Empty !!");
                        document.chngpwd.cnfpass.focus();
                        return false;
                    } else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value)
                    {
                        alert("Password and Confirm Password Field do not match  !!");
                        document.chngpwd.cnfpass.focus();
                        return false;
                    }
                    return true;
                }
            </script>

        </head>
        <body class="cnt-home">
            <header class="header-style-1">

                <!-- ============================================== TOP MENU ============================================== -->
                <?php include('includes/top-header.php'); ?>    <br><br><br>
                <!-- ============================================== TOP MENU : END ============================================== -->
                <?php include('includes/main-header.php'); ?>
                <!-- ============================================== NAVBAR ============================================== -->
                <?php include('includes/menu-bar.php'); ?>
                <!-- ============================================== NAVBAR : END ============================================== -->

            </header>
            <!-- ============================================== HEADER : END ============================================== -->

            <div class="body-content outer-top-bd">
                <div class="container">
                    <div class="checkout-box inner-bottom-sm">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-group checkout-steps" id="accordion">
                                    <!-- checkout-step-01  -->
                                    <div class="panel panel-default checkout-step-01">

                                        <!-- panel-heading -->
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">
                                                <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                                    <span>1</span>My Profile
                                                </a>
                                            </h4>
                                        </div>
                                        <!-- panel-heading -->

                                        <div id="collapseOne" class="panel-collapse collapse in">

                                            <!-- panel-body  -->
                                            <div class="panel-body">
                                                <div class="row">		
                                                    <h4>Personal info</h4>
                                                    <div class="col-md-12 col-sm-12 already-registered-login">

                                                        <?php
                                                        $query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            ?>

                                                            <form class="register-form" role="form" method="post">
                                                                <div class="form-group">
                                                                    <label class="info-title" for="name">Name<span>*</span></label>
                                                                    <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['name']; ?>" id="name" name="name" required="required">
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="<?php echo $row['email']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="info-title" for="Contact No.">Contact No. <span>*</span></label>
                                                                    <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" value="<?php echo $row['contactno']; ?>"  maxlength="10">
                                                                </div>
                                                                <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                                                            </form>
                                                        <?php } ?>
                                                    </div>	
                                                    <!-- already-registered-login -->		

                                                </div>			
                                            </div>
                                            <!-- panel-body  -->

                                        </div><!-- row -->
                                    </div>
                                    <!-- checkout-step-01  -->
                                    <!-- checkout-step-02  -->
                                    <div class="panel panel-default checkout-step-02">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">
                                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                                    <span>2</span>Change Password
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <form class="register-form" role="form" method="post" name="chngpwd" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label class="info-title" for="Current Password">Current Password<span>*</span></label>
                                                        <input type="password" class="form-control unicase-form-control text-input" id="cpass" name="cpass" required="required">
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="info-title" for="New Password">New Password <span>*</span></label>
                                                        <input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="Confirm Password">Confirm Password <span>*</span></label>
                                                        <input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass" required="required" >
                                                    </div>
                                                    <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Change </button>
                                                </form> 




                                            </div>
                                        </div>
                                    </div>
                                    <!-- checkout-step-02  -->

                                    <!-- checkout-step-03  -->
                                    <div class="panel panel-default checkout-step-03">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">
                                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                                                    <span>3</span>Shipping Address
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <?php
                                                $query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                    <form class="register-form" role="form" method="post">
                                                        <div class="form-group">
                                                            <label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
                                                            <textarea class="form-control unicase-form-control text-input" " name="shippingaddress" required="required"><?php echo $row['shippingAddress']; ?></textarea>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="info-title" for="Shipping State ">Shipping State  <span>*</span></label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shippingState']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title" for="Shipping City">Shipping City <span>*</span></label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity']; ?>" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="info-title" for="Shipping Pincode">Shipping Pincode <span>*</span></label>
                                                            <input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode']; ?>" >
                                                        </div>


                                                        <button type="submit" name="updateshippingaddress" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                                                    </form>
                                                <?php } ?>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            


                                </div><!-- /.checkout-steps -->
                            </div>



                            <?php include('includes/myaccount-sidebar.php'); ?>
                        </div><!-- /.row -->
                    </div><!-- /.checkout-box -->
                    <?php include('includes/brands-slider.php'); ?>

                </div>
            </div>
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

            <!-- For demo purposes – can be removed on production -->

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