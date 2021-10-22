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
            header('location:my-cart.php');
        } else {
            $message = "Product ID is invalid";
        }
    }
}
$pid = intval($_GET['pid']);
if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
    if (strlen($_SESSION['login']) == 0) {
        header('location:login.php');
    } else {
        mysqli_query($con, "insert into wishlist(userId,productId) values('" . $_SESSION['id'] . "','$pid')");
        echo "<script>alert('Product aaded in wishlist');</script>";
        header('location:my-wishlist.php');
    }
}
if (isset($_POST['submit'])) {
    $qty = $_POST['quality'];
    $price = $_POST['price'];
    $value = $_POST['value'];
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $review = $_POST['review'];
    mysqli_query($con, "insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <title>Product Details</title>
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

    </head>
    <body class="cnt-home">

        <header class="header-style-1">

            <!-- ============================================== TOP MENU ============================================== -->
            <?php include('includes/top-header.php'); ?>
            <br><br>   <br><br>
            <!-- ============================================== TOP MENU : END ============================================== -->
            <?php include('includes/main-header.php'); ?>
            <!-- ============================================== NAVBAR ============================================== -->
            <?php include('includes/menu-bar.php'); ?>
            <!-- ============================================== NAVBAR : END ============================================== -->

        </header>

        <!-- ============================================== HEADER : END ============================================== -->

        <div class="body-content outer-top-xs">
            <div class='container'>
                <div class='row single-product outer-bottom-sm '>
                    <div class='col-md-3 sidebar'>
                        <div class="sidebar-module-container">


                            <!-- ==============================================CATEGORY============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">Category</h3>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="accordion">

                                        <?php
                                        $sql = mysqli_query($con, "select id,categoryName from category");
                                        while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a href="category.php?cid=<?php echo $row['id']; ?>"  class="accordion-toggle collapsed">
                                                        <?php echo $row['categoryName']; ?>
                                                    </a>
                                                </div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================== CATEGORY : END ============================================== -->					<!-- ============================================== HOT DEALS ============================================== -->
                            <div class="sidebar-widget hot-deals wow fadeInUp">


                            </div>

                        </div>
                    </div><!-- /.sidebar -->
                    <?php
                    $ret = mysqli_query($con, "select * from products where id='$pid'");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>


                        <div class='col-md-9'>
                            <div class="row  wow fadeInUp">
                                <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                    <div class="product-item-holder size-big single-product-gallery small-gallery">

                                        <div id="owl-single-product">

                                            <div class="single-product-gallery-item" id="slide1">
                                                <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
                                                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
                                                </a>
                                            </div>


                                        </div><!-- /.single-product-slider -->




                                    </div>
                                </div>     			




                                <div class='col-sm-6 col-md-7 product-info-block'>
                                    <div class="product-info">
                                        <h1 class="name"><?php echo htmlentities($row['productName']); ?></h1>
                                        <?php
                                        $rt = mysqli_query($con, "select * from productreviews where productId='$pid'");
                                        $num = mysqli_num_rows($rt);
                                        {
                                            ?>		
                                            <div class="rating-reviews m-t-20">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="rating rateit-small"></div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="reviews">
                                                            <a href="#" class="lnk">(<?php echo htmlentities($num); ?> Reviews)</a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.row -->		
                                            </div><!-- /.rating-reviews -->
                                        <?php } ?>
                                        <div class="stock-container info-container m-t-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="stock-box">
                                                        <span class="label">Availability :</span>
                                                    </div>	
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="stock-box">
                                                        <span class="value"><?php echo htmlentities($row['productAvailability']); ?></span>
                                                    </div>	
                                                </div>
                                            </div><!-- /.row -->	
                                        </div>


                                        <div class="stock-container info-container m-t-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="stock-box">
                                                        <span class="label">Shipping Charge :</span>
                                                    </div>	
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="stock-box">
                                                        <span class="value"><?php
                                                            if ($row['shippingCharge'] == 0) {
                                                                echo "Free";
                                                            } else {
                                                                echo htmlentities($row['shippingCharge']);
                                                            }
                                                            ?></span>
                                                    </div>	
                                                </div>
                                            </div><!-- /.row -->	
                                        </div>


                                        <div class="price-container info-container m-t-20">
                                            <div class="row">


                                                <div class="col-sm-6">
                                                    <div class="price-box">
                                                        <span class="price">RM<?php echo htmlentities($row['productPrice']); ?></span>
                                                        <span class="price-strike">RM<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>
                                                    </div>
                                                </div>




                                                <div class="col-sm-6">
                                                    <div class="favorite-button m-t-10">
                                                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>

                                                        </a>
                                                    </div>
                                                </div>

                                            </div><!-- /.row -->
                                        </div><!-- /.price-container -->




                                        <div class="price-container info-container m-t-12">


                                            <div class="panel panel-default">
                                                <div class="panel-heading panel-default">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Comes With</a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        Candle, Knife 

                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Allergens</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse2" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            With eggs, milk/dairy's</div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>


                                        <div class="quantity-container info-container">
                                            <div class="row">



                                                <div class="col-sm-7">
                                                    <a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>"        
                                                       class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>

                                                </div>


                                            </div><!-- /.row -->
                                        </div><!-- /.quantity-container -->

                                        <div class="product-social-link m-t-20 text-right">
                                            <span class="social-label">Share :</span>
                                            <div class="social-icons">
                                                <ul class="list-inline">
                                                    <li><a class="fa fa-facebook" href="http://facebook.com/"></a></li>
                                                    <li><a class="fa fa-twitter" href="https://twitter.com/?lang=en"></a></li>
                                                    <li><a class="fa fa-instagram" href="https://www.instagram.com/"></a></li>

                                                    <li><a class="fa fa-pinterest" href="https://www.pinterest.com/"></a></li>
                                                </ul><!-- /.social-icons -->
                                            </div>
                                        </div>




                                    </div><!-- /.product-info -->
                                </div><!-- /.col-sm-7 -->
                            </div><!-- /.row -->


                            <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                            <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                            <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                        </ul><!-- /.nav-tabs #product-tabs -->
                                    </div>
                                    <div class="col-sm-9">

                                        <div class="tab-content">

                                            <div id="description" class="tab-pane in active">
                                                <div class="product-tab">
                                                    <p class="text"><?php echo $row['productDescription']; ?></p>
                                                </div>	
                                            </div><!-- /.tab-pane -->

                                            <div id="review" class="tab-pane">
                                                <div class="product-tab">

                                                    <div class="product-reviews">
                                                        <h4 class="title">Customer Reviews</h4>
                                                        <?php
                                                        $qry = mysqli_query($con, "select * from productreviews where productId='$pid'");
                                                        while ($rvw = mysqli_fetch_array($qry)) {
                                                            ?>

                                                            <div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
                                                                <div class="review">
                                                                    <div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']); ?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']); ?></span></span></div>

                                                                    <div class="text">"<?php echo htmlentities($rvw['review']); ?>"</div>
                                                                    <div class="text"><b>Quality :</b>  <?php echo htmlentities($rvw['quality']); ?> Star</div>
                                                                    <div class="text"><b>Price :</b>  <?php echo htmlentities($rvw['price']); ?> Star</div>
                                                                    <div class="text"><b>value :</b>  <?php echo htmlentities($rvw['value']); ?> Star</div>
                                                                    <div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']); ?></span></div>													</div>

                                                            </div>
                                                        <?php } ?><!-- /.reviews -->
                                                    </div><!-- /.product-reviews -->
                                                    <form role="form" class="cnt-form" name="review" method="post">


                                                        <div class="product-add-review">
                                                            <h4 class="title">Write your own review</h4>
                                                            <div class="review-table">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">	
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="cell-label">&nbsp;</th>
                                                                                <th>1 star</th>
                                                                                <th>2 stars</th>
                                                                                <th>3 stars</th>
                                                                                <th>4 stars</th>
                                                                                <th>5 stars</th>
                                                                            </tr>
                                                                        </thead>	
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="cell-label">Quality</td>
                                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="cell-label">Price</td>
                                                                                <td><input type="radio" name="price" class="radio" value="1"></td>
                                                                                <td><input type="radio" name="price" class="radio" value="2"></td>
                                                                                <td><input type="radio" name="price" class="radio" value="3"></td>
                                                                                <td><input type="radio" name="price" class="radio" value="4"></td>
                                                                                <td><input type="radio" name="price" class="radio" value="5"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="cell-label">Value</td>
                                                                                <td><input type="radio" name="value" class="radio" value="1"></td>
                                                                                <td><input type="radio" name="value" class="radio" value="2"></td>
                                                                                <td><input type="radio" name="value" class="radio" value="3"></td>
                                                                                <td><input type="radio" name="value" class="radio" value="4"></td>
                                                                                <td><input type="radio" name="value" class="radio" value="5"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table><!-- /.table .table-bordered -->
                                                                </div><!-- /.table-responsive -->
                                                            </div><!-- /.review-table -->

                                                            <div class="review-form">
                                                                <div class="form-container">


                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                                <input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
                                                                            </div><!-- /.form-group -->
                                                                            <div class="form-group">
                                                                                <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                                <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
                                                                            </div><!-- /.form-group -->
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputReview">Review <span class="astk">*</span></label>

                                                                                <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
                                                                            </div><!-- /.form-group -->
                                                                        </div>
                                                                    </div><!-- /.row -->

                                                                    <div class="action text-right">
                                                                        <button name="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                                    </div><!-- /.action -->

                                                                    </form><!-- /.cnt-form -->
                                                                </div><!-- /.form-container -->
                                                            </div><!-- /.review-form -->

                                                        </div><!-- /.product-add-review -->										

                                                </div><!-- /.product-tab -->
                                            </div><!-- /.tab-pane -->



                                        </div><!-- /.tab-content -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.product-tabs -->

                            <?php
                            $cid = $row['category'];
                        }
                        ?>

                    </div><!-- /.col -->
                    <div class="clearfix"></div>
                </div>

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


</body>
</html>