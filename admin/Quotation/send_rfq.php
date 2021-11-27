<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT q.*, s.* from `quotation` q inner join `vendor` s on q.vendor_ID  = s.vendor_ID where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<?php
$sup_qry = $conn->query("SELECT q.*, s.* from `quotation` q inner join `vendor` s on q.vendor_ID  = s.vendor_ID where id = '{$id}'");
$supplier = $sup_qry->fetch_array();
$order_items_qry = $conn->query("SELECT o.*,i.* FROM `rfq` o inner join inventory i on o.item_id = i.id where o.`rfq_no` = '$id' ");
$row = $order_items_qry->fetch_assoc();
$comp_name = $_settings->info('company_name');
$comp_add = $_settings->info('company_address');
$comp_img = $_settings->info('logo');
$name = $toEmail = $supplier["name"];
$sup_code = $supplier['company_code'];
$prod = $supplier['product'];
$desc = $supplier['description'];
$creation_date = $supplier['date_created'];
$date = date("Y-m-d", strtotime($creation_date));
$qty = $row['quantity'];
$itemName = $row['name'];
$itemCode = $row['item_code'];
$itemDesc = $row['description'];
$unitPrice = $row['unit_price'];
$totalPrice = ($row['quantity'] * $row['unit_price']);
$sub_total = 0;
$sub_total = number_format($row['quantity'] * $row['unit_price']);
$rem = $supplier['remarks'];
$qNum = $supplier['q_ID'];

if (isset($_POST['sendMailBtn'])) {
    $fromEmail = $_settings->info('company_email');
    $toEmail = $supplier['email'];


    $to = "$toEmail";
    $subject = "PO";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $fromEmail . '<' . $fromEmail . '>' . "\r\n" . 'Reply-To: ' . $fromEmail . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    $message = '<!doctype html>
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
        <h3 class="card-title">Quotation Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0">Company Name: ' . $comp_name . '</p>
                    <p class="m-0">Email address: ' . $fromEmail . '</p>
                    <p class="m-0">Delivery address:' . $comp_add . '</p>
                </div>
            </div>
            <div class="col-6">
                <center><img src="' . $comp_img . '" alt="" height="200px"></center>
                <h2 class="text-center"><b>QUOTATION</b></h2>
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
                    <p  class="m-0"><b>RFQ Number: ' . $qNum . '</b></p>
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date Created: ' . $date . '</b></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <colgroup>
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled" style="">
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
    $result = @mail($to, $subject, $message, $headers);

    echo '<script>alert("This quotation has been sent successfully to the supplier!")</script>';
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
        <h3 class="card-title">Review Quotation</h3>
        <div class="card-tools">
            <form action="" id="email-form" method="post" class="form-mail">
                <button class="btn btn-sm btn-flat btn-info" id="sendMailBtn" name="sendMailBtn" type="submit"><i class="fa fa-envelope"></i> Confirm & Send</button>
            </form>
            <br>
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-default" href="?page=RFQ">Back</a>
        </div>
    </div>
    <div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0" name="fromEmail" id="fromEmail"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-6">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                <h2 class="text-center"><b>PURCHASE ORDER</b></h2>
            </div>
        </div>
        <div class="row mb-2">
           
            <div class="col-6 row">
                <div class="col-6">
                    <p  class="m-0"><b>RFQ. #:</b></p>
                    <p><b><?php echo $q_ID ?></b></p>
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date Created</b></p>
                    <p><b><?php echo date("Y-m-d", strtotime($date_created)) ?></b></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="item-list">
                   <colgroup>
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
                        <?php
                        if (isset($id)):
                            $rfq_qry = $conn->query("SELECT o.*,i.name, i.description, i.item_code FROM `rfq` o inner join inventory i on o.item_id = i.id where o.`rfq_no` = '$id' ");
                            $total = 0;
                            while ($row = $rfq_qry->fetch_assoc()):
                                $total += ($row['quantity'] * $row['unit_price']);
                                ?>
                                <tr class=rfq-item" data-id="">
                                    <td class="align-middle p-2 text-center"><?php echo $row['quantity'] ?></td> 
                                    <td class="align-middle p-2 text-center"><?php echo $row['name'] ?></td>     
                                    <td class="align-middle p-2 text-center"><?php echo $row['item_code'] ?></td> 
                                    <td class="align-middle p-2 text-center"><?php echo $row['description'] ?></td>
                                    <td class="align-middle p-2 text-center"><?php echo $row['unit_price'] ?></td>
                                    <td class="align-middle p-2 text-center total-price"><?php echo number_format($row['quantity'] * $row['unit_price']) ?></td>

                                </tr>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </tbody>
                   <tfoot>                       
                        <tr>
                        <tr>
                            <th class="p-1 text-right" colspan="5">Total</th>
                            <th class="p-1 text-right" id="total"><?php echo number_format($total) ?></th>
                        </tr>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-6">
                        <label for="notes" class="control-label">Notes</label>
                        <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                    </div>
                    <div class="col-6">
                        <label for="status" class="control-label">Status</label>
                        <br>
                        <?php
                        switch ($status) {
                            case 1:
                                echo "<span class='py-2 px-4 btn-flat btn-success'>Approved</span>";
                                break;
                            case 2:
                                echo "<span class='py-2 px-4 btn-flat btn-danger'>Inactive</span>";
                                break;
                            default:
                                echo "<span class='py-2 px-4 btn-flat btn-secondary'>Pending</span>";
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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