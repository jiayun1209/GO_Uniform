<?php
include 'include/config.php';
$data = mysqli_query($con, "select * from users");

?>

<html>
    <head>
        <title>Users (Membership) Report</title>

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
        <h1 align="center">GO Uniform Trading Sdn Bhd <br/>Membership Report</h1>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader center">
                <th rowspan="1">Membership ID</th>
                <th>Name</th>
                  <th>Gender</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Shipping Address</th>
                <th>Registration Date</th>
            </tr>
            <?php while ($order = mysqli_fetch_array($data)) { ?>
                <tr id="rowHover">
                   
                     <td width="10%" align="center"><?php echo $order['id']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['name']; ?></td>
                     <td width="10%" id="column_padding"><?php echo $order['gender']; ?></td>
                    <td width="14%" id="column_padding"><?php echo $order['email']; ?></td>
                      <td width="10%" id="column_padding"><?php echo $order['contactno']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['shippingAddress']; ?></td>
                    <td width="10%" id="column_padding"><?php echo $order['regDate']; ?></td>
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