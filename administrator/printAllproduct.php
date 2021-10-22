<?php
include 'include/config.php';

$data = mysqli_query($con, "select * from products");

?>

<html>
    <head>
        <title>All Products Report</title>

        <style>
            .img-responsive {
                margin-left: auto;
                margin-right: auto;

            }

            .center1 {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 30%;
            }

        </style>

    </head>
    <body>

        <img class="img-responsive center1" src="logo.jpg" alt="JellyCake Logo">
        <h1 align="center">GO Uniform Trading Sdn Bhd <br/>All Products Report</h1>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader center">
             <th rowspan="1">Product ID</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Previous Price</th>
           
                <th>Availability</th>
                <th>Posting Date</th>
            </tr>
            <?php while ($order = mysqli_fetch_array($data)) { ?>
                <tr id="rowHover">
                   
                     <td width="10%" align="center"><?php echo $order['id']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['category']; ?></td>
                    <td width="14%" id="column_padding"><?php echo $order['productName']; ?></td>
                      <td width="10%" id="column_padding"><?php echo $order['productPrice']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['productPriceBeforeDiscount']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['productAvailability']; ?></td>
                       <td width="13%" id="column_padding"><?php echo $order['postingDate']; ?></td>
                </tr>
            <?php } ?>
        </table><p>
            <script>
                window.load = print_d();
                function print_d() {
                    window.print();
                }
            </script>
            <a href="todays-orders.php"><button style="margin-left:5%">Back</button>
    </body>
</html>