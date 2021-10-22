<?php
include 'include/config.php';
$data = mysqli_query($con, "select orders.id, orders.userId, orders.productId, products.productName, orders.quantity, orders.orderDate, orders.paymentMethod, 
    orders.orderStatus from orders INNER JOIN products On orders.productId=products.id");

?>
<html>
    <head>
        <title>Report (Orders)</title>


        <style>.tableheader{
                background:#999999;
                color:#FFFFFF;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
                height:30px;
            }

            #column_padding{
                padding-left:2%;
            }

            td a {
                text-decoration:none;
                color:#0033CC;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }


            .form{
                margin:0px;
                margin-left:15px;
            }

            input[type="text"]{
                width:95%;
            }

            input[type="radio"]{
                width:20%;
            }

            .tableadd {
                background:#CCCCCC;
                padding:20px;
                border:solid 1px;
            }

            .img-responsive {
                margin-left: auto;
                margin-right: auto;

            }

            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 30%;
            }

        </style>

    </head>
    <body>

        <img class="img-responsive center" src="logo.jpg" alt="JellyCake Logo">

        <h1 align="center">Orders Report</h1>
        <p>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader">
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
        </table>
        <br />
        <button style="margin-left:5%" onclick="print_d()">Print Report</button>
        <script>
            function print_d() {
                window.open("printOrders.php", "_blank");
            }
        </script>
    </body>
</html>