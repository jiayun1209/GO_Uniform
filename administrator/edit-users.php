
<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']); // user id
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $contactno = $_POST['contactno'];
        $password = $_POST['password'];
        $shippingAddress = $_POST['shippingAddress'];
        $shippingState = $_POST['shippingState'];
        $shippingCity = $_POST['shippingCity'];
        $shippingPincode = $_POST['shippingPincode'];

        $sql = mysqli_query($con, "update users set name='$name',gender='$gender',contactno='$contactno',"
                . "password='$password',shippingAddress='$shippingAddress',shippingState='$shippingState',"
                . "shippingCity='$shippingCity', shippingPincode='$shippingPincode' where id='$id'");
        $_SESSION['msg'] = "Users Updated Successfully !!";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Administrator | Edit Users</title>
            <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
            <link type="text/css" href="css/theme.css" rel="stylesheet">
            <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
            <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
            <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
            <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

            <script>

                function selectCountry(val) {
                    $("#search-box").val(val);
                    $("#suggesstion-box").hide();
                }
            </script>	


        </head>
        <body>
    <?php include('include/header.php'); ?>

            <div class="wrapper">
                <div class="container">
                    <div class="row">
            <?php include('include/sidebar.php'); ?>				
                        <div class="span9">
                            <div class="content">

                                <div class="module">
                                    <div class="module-head">
                                        <h3>Update Users</h3>
                                    </div>
                                    <div class="module-body">

    <?php if (isset($_POST['submit'])) {
        ?>
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                            </div>
                                        <?php } ?>


    <?php if (isset($_GET['del'])) {
        ?>
                                            <div class="alert alert-error">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                            </div>
                                        <?php } ?>

                                        <br />

                                        <form class="form-horizontal row-fluid" name="updateuser" method="post" enctype="multipart/form-data">

                                        <?php
                                    $query=mysqli_query($con,"select name,gender,email,contactno, password, shippingAddress,shippingState,shippingCity,shippingPincode from users where id='$id'");  
                                  
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>


                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput"> Name</label>
                                                    <div class="controls">
                                                        <input type="text" name="name"  placeholder="Enter Name" value="<?php echo htmlentities($row['name']); ?>" class="span8 tip" >
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Gender</label>
                                                    <div class="controls">
                                                        <input type="text"name="gender"  placeholder="Enter Gender" value="<?php echo htmlentities($row['gender']); ?>" class="span8 tip" >
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Contact No</label>
                                                    <div class="controls">
                                                        <input type="text"    name="contactno"  placeholder="Enter Contact No" value="<?php echo htmlentities($row['contactno']); ?>" class="span8 tip" >
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Password</label>
                                                    <div class="controls">
                                                        <input type="text"    name="password"  placeholder="Enter password" value="<?php echo htmlentities($row['password']); ?>"  class="span8 tip" required>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Shipping Address</label>
                                                    <div class="controls">
                                                        <input type="text" name="shippingAddress"  placeholder="Enter Shipping Address" value=""<?php echo htmlentities($row['shippingAddress']); ?>" class="span8 tip" required>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Shipping State</label>
                                                    <div class="controls">
                                                         <input type="text" name="shippingState"  placeholder="Enter Shipping State" value=""<?php echo htmlentities($row['shippingState']); ?>" class="span8 tip" required>
                                                     
                                                    </div>
                                                </div>
                                            
                                            <div class="control-group">
                                                    <label class="control-label" for="basicinput">Shipping City</label>
                                                    <div class="controls">
                                                         <input type="text" name="shippingCity"  placeholder="Enter Shipping City" value=""<?php echo htmlentities($row['shippingCity']); ?>" class="span8 tip" required>
                                                     
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Shipping Postcode</label>
                                                    <div class="controls">
                                                        <input type="text"    name="shippingPincode"  placeholder="Enter Shipping Postcode" value="<?php echo htmlentities($row['shippingPincode']); ?>" class="span8 tip" required>
                                                    </div>
                                                </div>

    <?php } ?>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <button type="submit" name="submit" class="btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>





                            </div><!--/.content-->
                        </div><!--/.span9-->
                    </div>
                </div><!--/.container-->
            </div><!--/.wrapper-->

    <?php include('include/footer.php'); ?>

            <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
            <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
            <script src="scripts/datatables/jquery.dataTables.js"></script>
            <script>
           $(document).ready(function () {
               $('.datatable-1').dataTable();
               $('.dataTables_paginate').addClass("btn-group datatable-pagination");
               $('.dataTables_paginate > a').wrapInner('<span />');
               $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
               $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
           });
            </script>
        </body>
<?php } ?>