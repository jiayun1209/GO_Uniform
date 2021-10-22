<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if (mysqli_num_rows($query_p) != 0) {
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
            header('location:index.php');
        } else {
            $message = "Product ID is invalid";
        }
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

        <title>GO Uniform Trading Sdn Bhd  Home Page</title>

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
        <style>
            /* Style the moving text */
            .moveText {
                font-size: 44px;
                font-family: Brush Script MT, "Times New Roman", Times, serif;
                text-align: center;
                color:lightcoral;
                background-color: white;
            }


            .main-logo {
                width: 30%;
                max-width: 600px;
            }

            .img-responsive {
                margin-left: auto;
                margin-right: auto;
            }


            .callout {
                position: fixed;
                bottom: 35px;
                right: 20px;
                margin-left: 20px;
                max-width: 300px;
            }

            .callout-header {
                padding: 25px 15px;
                background: darksalmon;
                font-size: 15px;
                color: black;
            }

            .callout-container {
                padding: 15px;
                background-color: lightcoral;
                color: black
            }

            .closebtn {
                position: absolute;
                top: 5px;
                right: 15px;
                color: white;
                font-size: 30px;
                cursor: pointer;
            }

            .closebtn:hover {
                color: lightgrey;


        </style>

    </head>
    <body class="cnt-home">

        <!-- ============================================== HEADER ============================================== -->
        <header class="header-style-1">
            <?php include('includes/top-header.php'); ?>
            <br><br>   <br><br>
            <img class="main-logo img-responsive" src="img/logo.png" alt="JellyCake Logo">
            <?php include('includes/main-header.php'); ?>
            <?php include('includes/menu-bar.php'); ?>
        </header>


        <div class="background">
            <div class="moveText">
                <marquee> Start your journey with us, GO Uniform Trading Sdn Bhd  . . . &nbsp; &nbsp;</marquee>
            </div>
            <!--                <div class="container text-center">-->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="img/slide1.jpg" alt="Jelly1" style="height:800px;width:1400px">

                        <div class="carousel-caption">
                            <h3>Welcome</h3>
                            <p>Enjoy your day T-Shirt</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="img/slide2.jpg" alt="Jelly2" style="height:800px;width:1400px">
                        <div class="carousel-caption">
                            <h3>Welcome</h3>
                            <p>Unique Design</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="img/slide3.jpg" alt="Jelly3" style="height:800px;width:1400px">
                        <div class="carousel-caption">
                            <h3>Welcome</h3>
                            <p>Feel free to contact us for more information </p>
                        </div>
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        <br><br>


        <div class="container">    
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">BIRTHDAY CAKE DEAL</div>

                        <div class="panel-body">

                            <img src="img/birthdaycakes.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Buy 2 cake and get a gift card 
                            &nbsp;&nbsp;&nbsp;</div>

                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">BELOW 100</div>
                        <div class="panel-body"><img src="img/below100.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Promotion of Jelly Cake below 100
                            &nbsp;&nbsp;&nbsp;</div>

                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">BIRTHDAY SETS</div>
                        <div class="panel-body"><img src="img/sets.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Get beautiful decoration of Cake Suprise
                            &nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">CUPCAKES</div>
                        <div class="panel-body"><img src="img/cupcakes.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Graceful design of Cupcakes 
                            &nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">CHOCOLATE CAKE</div>
                        <div class="panel-body"><img src="img/choc.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Decorate based on client's requirement
                            &nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">ICE CREAM JELLY CAKE</div>
                        <div class="panel-body"><img src="img/icecreamcake.png" class="img-responsive" style="height:350px;width:550px" alt="Image"></div>
                        <div class="panel-footer">Jelly Cake with Ice Cream taste
                            &nbsp;&nbsp;&nbsp;</div>
                    </div>
                </div>
            </div>





            <!-- ============================================== HEADER : END ============================================== -->
            <div class="body-content outer-top-xs" id="top-banner-and-menu">
                <div class="container">
                    <div class="furniture-container homepage-container">
                        <div class="row">

                            <!-- ========================================= SECTION – HERO : END ========================================= -->	
                        </div><!-- /.homebanner-holder -->

                    </div><!-- /.row -->

                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                        <div class="more-info-tab clearfix">
                            <h3 class="new-product-title pull-left">Products</h3>			
                        </div>

                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">			
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                        <?php
                                        $ret = mysqli_query($con, "select * from products");
                                        while ($row = mysqli_fetch_array($ret)) {
                                            ?>


                                            <div class="item item-carousel">
                                                <div class="products">

                                                    <div class="product">		
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                    <img  src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"  width="180" height="300" alt=""></a>
                                                            </div><!-- /.image -->			


                                                        </div><!-- /.product-image -->


                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>

                                                            <div class="product-price">	
                                                                <span class="price">
                                                                    RM <?php echo htmlentities($row['productPrice']); ?>			</span>
                                                                <span class="price-before-discount">RM <?php echo htmlentities($row['productPriceBeforeDiscount']); ?>	</span>

                                                            </div><!-- /.product-price -->

                                                        </div><!-- /.product-info -->
                                                        <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
                                                    </div><!-- /.product -->

                                                </div><!-- /.products -->
                                            </div><!-- /.item -->
                                        <?php } ?>

                                    </div><!-- /.home-owl-carousel -->
                                </div><!-- /.product-slider -->
                            </div>




                        </div>

                    </div>
                </div>
            </div>
        </div>
  <div class="callout">
                    <div class="callout-header">Register with GO Uniform Trading Sdn Bhd  Now</div>
                    <span class="closebtn" onclick="this.parentElement.style.display = 'none';">×</span>
                    <div class="callout-container">
                        <p>Enjoy the benefits with us by register your membership's <a href="login.php">Register Now</a> or close it if it is in your way.</p>
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
        <!-- For demo purposes â€“ can be removed on production : End -->



    </body>
</html>