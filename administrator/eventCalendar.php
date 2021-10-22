<?php
include 'include/config.php';
$data = mysqli_query($con, "select * from products");

?>
<html>
    <head>
        <title>Event Calendar</title>


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

        <h1 align="center">Event Calendar</h1>
        <p>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader">
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
        </table>
        <br />
        <button style="margin-left:5%" onclick="print_d()">Print Report</button>
        <script>
            function print_d() {
                window.open("printAllproduct.php", "_blank");
            }
        </script>
    </body>
</html>