<?php
include 'include/config.php';
$data = mysqli_query($con, "select * from users");

?>
<html>
    <head>
        <title>Branches (Partnership) Report</title>


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

        <h1 align="center">Partnership Report</h1>
        <p>
        <table border="1" width="90%" style="border-collapse:collapse;" align="center">
            <tr class="tableheader">
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
        </table>
        <br />
        <button style="margin-left:5%" onclick="print_d()">Print Report</button>
        <script>
            function print_d() {
                window.open("printMembership.php", "_blank");
            }
        </script>
    </body>
</html>