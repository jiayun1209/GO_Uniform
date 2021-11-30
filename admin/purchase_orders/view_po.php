<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `purchase_order` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
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
        <h3 class="card-title"><b><?php echo isset($id) ? "Purchase Order Details" : "New Purchase Order" ?></b></h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-primary" href="?page=purchase_orders/manage_po&id=<?php echo $id ?>">Edit</a>
            <a class="btn btn-sm btn-flat btn-default" href="?page=purchase_orders">Back</a>
        </div>
    </div>
    <div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address'). " " .$_settings->info('company_address_1')." ".$_settings->info('company_postcode')." ".$_settings->info('company_city')?></p>
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
                <div class="col-4">
                    <p  class="m-0 text-center"><b>PO Number: </b></p>
                    <p class="text-center"><?php echo $po_no ?></p>
                </div>
                <div class="col-4">
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
                    <div class="col-6">
                        <label for="status" class="control-label">Status</label>
                        <br>
                        <?php
                        switch ($status) {
                            case 1:
                                echo "<span class='py-2 px-4 btn-flat btn-success'>Approved</span>";
                                break;
                            case 2:
                                echo "<span class='py-2 px-4 btn-flat btn-danger'>Rejected</span>";
                                break;
                            case 3:
                                echo "<span class='py-2 px-4 btn-flat btn-warning text-danger'>Cancelled</span>";
                                break;
                            default:
                                echo "<span class='py-2 px-4 btn-flat btn-secondary'>Pending</span>";
                                break;
                        }
                        ?>
                        <br><br><br>
                        <?php if ($status == 3): ?>
                            <label for="cancel_reason" class="control-label">Cancellation Reason</label>
                            <p><?php echo isset($cancel_reason) ? $cancel_reason : '' ?></p>
                        <?php endif; ?>
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
        <td class="align-middle p-1 item-code"></td>
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
