<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT po.*, s.* from `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

//Grab variables
$sup_qry = $conn->query("SELECT p.*, s.* from `purchase_order` p inner join `vendor` s on p.vendor_ID  = s.vendor_ID where id = '{$id}'");
$supplier = $sup_qry->fetch_array();
$order_items_qry = $conn->query("SELECT o.*, i.item_code, i.name, i.description FROM `purchase_order_details` o inner join inventory i on o.item_id = i.id where o.`po_id` = '$id'");
$row = $order_items_qry->fetch_assoc();
$comp_name = $_settings->info('company_name');
$comp_add = $_settings->info('company_address');
$comp_img = $_settings->info('logo');
$name = $supplier["name"];
$sup_code = $supplier['company_code'];
$prod = $supplier['product'];
$desc = $supplier['description'];
$toEmail = $supplier['email'];
$fromEmail = $_settings->info('company_email');
$creation_date = $supplier['date_created'];
$date = date("Y-m-d", strtotime($creation_date));
$delivery_date = $supplier['delivery_date'];
$date2 = date("Y-m-d", strtotime($delivery_date));
$qty = $row['quantity'];
$itemName = $row['name'];
$itemCode = $row['item_code'];
$itemDesc = $row['description'];
$unitPrice = $row['unit_price'];
$totalPrice = ($row['quantity'] * $row['unit_price']);
$sub_total = 0;
$sub_total = number_format($row['quantity'] * $row['unit_price']);
$rem = $supplier['remarks'];
$poNum = $supplier['po_no'];
$q_no = $supplier['quotation_no'];


$mpdf = new \Mpdf\Mpdf();

//Creating our PDF
$data = '';
$data .= //Add data
        $data .= '<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport"
					  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<title>Document</title>
			</head>
			<body>
                        <div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Purchase Order Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0">' . $comp_name . '</p>
                    <p class="m-0">' . $fromEmail . '</p>
                    <p class="m-0">' . $comp_add . '</p>
                </div>
            </div>
            <div class="col-6">
                <h2 class="text-center"><b>PURCHASE ORDER</b></h2>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><b>Vendor Details</b></p>
                <div>
                    <p>Vendor Name     : ' . $name . '</p>
                    <p>Company Code    : ' . $sup_code . '</p>                   
                    <p>Email address   :' . $toEmail . '</p>
                </div>
            </div>
            <div class="col-6 row">
                <div class="col-6">
                    <p  class="m-0"><b>PO Number: ' . $po_no . '</b></p>
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date Created: ' . $date . '</b></p>
                </div>
                  <div class="col-6">
                    <p  class="m-0"><b>Quotation No: ' . $q_no . '</b></p>                   
                </div>
            <div class="col-6">          
                    <p  class="m-0"><b>Delivery Date:  ' . $date2 . '</b></p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th class="px-1 py-1 text-center">Qty</th>
                            <th class="px-1 py-1 text-center">Item Name</th>
                            <th class="px-1 py-1 text-center">Item Code</th>
                            <th class="px-1 py-1 text-center">Description</th>
                            <th class="px-1 py-1 text-center">Unit Price (RM)</th>
                            <th class="px-1 py-1 text-center">Sub Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                                <tr class="po-item" data-id="">
                                    <td class="align-middle p-0 text-center">' . $qty . '</td>
                                    <td class="align-middle p-1">' . $itemName . '</td>
                                        <td class="align-middle p-1">' . $itemCode . '</td>
                                    <td class="align-middle p-1 item-description">' . $itemDesc . '</td>
                                    <td class="align-middle p-1">' . $unitPrice . '</td>
                                    <td class="align-middle p-1 text-right total-price">' . $sub_total . '</td>
                                </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-lightblue">                       
                        <tr>
                            <th class="p-1 text-right" colspan="4">Total</th>
                            <th class="p-1 text-right">' . $totalPrice . '</th>
                        </tr>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-6">
                        <label>Remarks</label>
                        <p>' . $remarks . '</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>   
			<br/>
                    Regards<br/>
                  ' . $fromEmail . '
				</div>
			</body>
			</html>';

//if ($message) {
//    $data .= '<br/><strong>Message</strong><br/>' . $message;
//}
//Write PDF
$mpdf->WriteHTML($data);

//Output to string
$pdf = $mpdf->Output('', 'S');

//Grab enquiry data
$enquirydata = [
    'First Name' => $comp_name,
    'Last Name' => $comp_add,
    'Email' => $fromEmail,
    'SupplierEmail' => $toEmail,
    'Supplier' => $name
];

//Run the function
if (isset($_POST['sendMailBtn'])) {
    sendEmail($pdf, $enquirydata);
}

function sendEmail($pdf, $enquirydata) {
    $emailbody = '';
    $emailbody .= '<h1>New Purchase Order from ' . $enquirydata['First Name'] . '</h1>';

    foreach ($enquirydata as $title => $data) {
        $emailbody .= '<strong>' . $data . '</br>';
    }

    $emailbody .= '';
    $emailbody .= '</br></br></br>Good day to you supplier ' . $enquirydata['First Name'] . ', as attached is the Purchase Order from GO Uniform Sdn Bhd.';
    $emailbody .= '';
    $emailbody .= '</br></br>Kindly inform us the estimated time for the goods arrived by email. </br></br>Thank you!';
    $emailbody .= '';
    $emailbody .= '</br></br></br>Regards, </br>' . $enquirydata['Email'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = '8c72a9f9c872a0';                     //SMTP username
        $mail->Password = 'b1c5b22a99908b';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Attachment
        $mail->addStringAttachment($pdf, 'myattachment.pdf');

        //Recipients
        $mail->setFrom($enquirydata['Email'], $enquirydata['First Name']);
        $mail->addAddress($enquirydata['SupplierEmail'], $enquirydata['Supplier']);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Purchase Order from ' . $enquirydata['First Name'];
        $mail->Body = $emailbody;
        $mail->AltBody = strip_tags($emailbody);

        $mail->send();
        echo '<script>alert("The Purchase Order has been successfully sent to the supplier!")</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    [name="tax_percentage"],[name="discount_percentage"]{
        width:5vw;
    }
</style>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><b><?php echo isset($id) ? "Purchase Order Details" : "Review Purchase Order" ?></b></h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-info" id="sendMailBtn" name="sendMailBtn" type="submit"><i class="fa fa-envelope"></i> Confirm to Send</button>


            <a class="btn btn-sm btn-flat btn-default" href="?page=purchase_orders">Cancel</a>
            </form>
        </div>
    </div>
    <form action="" id="email-form" method="post" class="form-mail">
        <div class="card-body" id="out_print">
            <div class="row">
                <div class="col-6 d-flex align-items-center">

                    <div>
                        <p class="m-0" name="fromEmail" id="fromEmail"><?php echo $_settings->info('company_name') ?></p>
                        <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                        <p class="m-0"><?php echo $_settings->info('company_address') . " " . $_settings->info('company_address_1') . " " . $_settings->info('company_postcode') . " " . $_settings->info('company_city') ?></p>
                    </div>
                </div>
                <div class="col-6">
                    <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                    <h2 class="text-center"><b>PURCHASE ORDER</b></h2>
                </div>
            </div>
            <br>
            <div class="row mb-2">
                <div class="col-6">
                    <p class="m-0"><b>Supplier Details</b></p>
                    <?php
                    $sup_qry = $conn->query("SELECT v.*,c.* FROM `vendor` v inner join company c on v.company_code = c.company_code where v.`vendor_ID` = '{$vendor_ID}' ");
                    $supplier = $sup_qry->fetch_array();
                    ?>
                    <div>
                        <p class="m-0"><?php echo $supplier['company_code'] ?> - <?php echo $supplier['name'] ?></p>                 
                        <p class="m-0"><?php echo $supplier['email'] ?></p>
                        <p class="m-0"><?php echo $supplier['address'] ?></p>
                    </div>
                </div>
                <div class="col-6 row">
                    <div class="col-6">
                        <p  class="m-0 text-center"><b>Quotation Number: </b></p>
                        <p class="text-center"><?php
                            if ($quotation_no == 0)
                                echo '';
                            else
                                echo $quotation_no;
                            ?>
                    </div>
                    <div class="col-4">
                        <p  class="m-0 text-center"><b>PO Number: </b></p>
                        <p class="text-center"><?php echo $po_no ?></p>
                    </div>
                    <div class="col-6">
                        <p class="m-0 text-center"><b>Date Created</b></p>
                        <p class="text-center"><?php echo date("Y-m-d", strtotime($date_created)) ?></p>
                    </div>
                    <div class="col-4">
                        <p  class="m-0 text-center"><b>Delivery Date</b></p>
                        <p class="text-center"><?php echo date("Y-m-d", strtotime($delivery_date)) ?></p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="15%">
                            <col width="10%">
                            <col width="25%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled" style="">
                                <th class="px-1 py-1 text-center">No.</th>
                                <th class="px-1 py-1 text-center">Qty</th>
                                <th class="px-1 py-1 text-center">Item Name</th>
                                <th class="px-1 py-1 text-center">Item Code</th>
                                <th class="px-1 py-1 text-center">Description</th>
                                <th class="px-1 py-1 text-center">Price (RM)</th>
                                <th class="px-1 py-1 text-center">Total (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (isset($id)):
                                $order_items_qry = $conn->query("SELECT o.*,i.item_code, i.name, i.description FROM `purchase_order_details` o inner join inventory i on o.item_id = i.id where o.`po_id` = '$id' ");
                                $sub_total = 0;
                                while ($row = $order_items_qry->fetch_assoc()):
                                    $sub_total += ($row['quantity'] * $row['unit_price']);
                                    ?>
                                    <tr class="po-item" data-id="">
                                        <td class="align-middle p-0 text-center"><?php echo $i++ ?></td>
                                        <td class="align-middle p-0 text-center"><?php echo $row['quantity'] ?></td>
                                        <td class="align-middle p-1 text-center"><?php echo $row['name'] ?></td>
                                        <td class="align-middle p-1 item-code text-center"><?php echo $row['item_code'] ?></td>
                                        <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
                                        <td class="align-middle p-1 text-right"><?php echo number_format($row['unit_price']) ?></td>
                                        <td class="align-middle p-1 text-right total-price"><?php echo number_format($row['quantity'] * $row['unit_price']) ?></td>
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="6">Sub Total</th>
                                <th class="p-1 text-right" id="sub_total"><?php echo number_format($sub_total) ?></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Discount (<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>%)
                                </th>
                                <th class="p-1 text-right"><?php echo isset($discount_amount) ? number_format($discount_amount) : 0 ?></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Tax Inclusive (<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>%)</th>
                                <th class="p-1 text-right"><?php echo isset($tax_amount) ? number_format($tax_amount) : 0 ?></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Total</th>
                                <th class="p-1 text-right" id="total"><?php echo isset($tax_amount) ? number_format($sub_total - $discount_amount) : 0 ?></th>
                            </tr>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-6">
                            <label for="remarks" class="control-label">Remarks</label>
                            <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>
        <td class="align-middle p-0 text-center">
            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
        </td>
        <td class="align-middle p-1">
            <input type="text" class="text-center w-100 border-0" name="unit[]"/>
        </td>
        <td class="align-middle p-1">
            <input type="hidden" name="item_id[]">
            <input type="text" class="text-center w-100 border-0 item_id" required/>
        </td>
        <td class="align-middle p-1 item-description"></td>
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
        </td>
        <td class="align-middle p-1 text-right total-price">0</td>
    </tr>
</table>
<script>
    $(function () {
        $('#print').click(function (e) {
            e.preventDefault();
            start_loader();
            var _h = $('head').clone()
            var _p = $('#out_print').clone()
            var _el = $('<div>')
            _p.find('thead th').attr('style', 'color:black !important')
            _el.append(_h)
            _el.append(_p)

            var nw = window.open("", "", "width=1200,height=950")
            nw.document.write(_el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    end_loader();
                    nw.close()
                }, 300);
            }, 200);
        })
    })
</script>