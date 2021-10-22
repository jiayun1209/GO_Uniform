<?php
include 'include/config.php';

$data = mysqli_query($con, "select orders.id, orders.userId, orders.productId, products.productName, orders.quantity, orders.orderDate, orders.paymentMethod, 
    orders.orderStatus from orders INNER JOIN products On orders.productId=products.id");
?>

<html>
    <head>
        <title>Orders Report</title>

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
        <h1 align="center">GO Uniform Trading Sdn Bhd <br/>Orders Report</h1>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader center">
                <th rowspan="1">Order ID</th>
                <th>User ID</th>
                <th>Product ID</th>
                 <th>Product Name</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Order Status</th>
            </tr>
            <?php while ($order = mysqli_fetch_array($data)) { ?>
                <tr id="rowHover">
                    <td width="10%" align="center"><?php echo $order['id']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['userId']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['productId']; ?></td>
                         <td width="10%" id="column_padding"><?php echo $order['productName']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['quantity']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['orderDate']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['paymentMethod']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['orderStatus']; ?></td>
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