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
    <div class="card-header ml-5 mr-5 mt-3 mb-2">
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-default" href="?page=report">Back</a>
        </div>
        <form action="" method="post">
            <div class="row date">
                <label class="py-2 text-left">From: </label>
                <div class="col-md-3 form-group">
                    <input type="date" name="start_date" class="text-center form-control"  placeholder="Start Date">                               
                </div>
                <label class="px-2 py-2 text-center">To: </label>
                <div class="col-md-3 form-group">
                    <input type="date" name="end_date" class="text-center form-control"  placeholder="End Date">                               
                </div>

            </div>
            <div class="row">
                <label class="py-2 text-left">Status: </label>
                <div class="col-md-3 form-group">
                    <select name="status" id="status" class="text-center form-control">
                        <option value="6">All</option>
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                        <option value="3">Cancelled</option>
                        <option value="4">Sent</option>
                        <option value="5">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitBtn" class="btn btn-sm btn-flat btn-primary text-center form-control"><i class="fa fa-search"></i> Search</button>
                </div>                 
            </div>

        </form> 
    </div>


    <div class="card-body ml-5 mr-5" id="out_print">
        <div class="row"><h2 class="text-center"><b>PURCHASE ORDER DETAILS REPORT</b></h2></div>

        <div class="row">
            <div class="col-9 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') . " " . $_settings->info('company_address_1') . " " . $_settings->info('company_postcode') . " " . $_settings->info('company_city') ?></p>
                </div>
            </div>
            <div class="col-3">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                <br><br>
            </div>
        </div>

        <table class="table table-hover table-striped" id="datatables">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="15%">
                <col width="20%">
                <col width="5%">
                <col width="25%">
                <col width="10%">

            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th class="text-center">No.</th>
                    <th class="text-left">Delivery Date</th>
                    <th class="text-left">PO No.</th>
                    <th class="text-left">Supplier Name</th>
                    <th class="text-center">Items</th>
                    <th class="text-right">Total Amount (RM)</th>
                    <th class="text-center">Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['submitBtn'])) {
                    if($_POST['start_date']!=''){
                        $start = $_POST['start_date'];
                    }else{
                        $start = '2021-01-01';
                    }
                    
                    if($_POST['end_date']!=''){
                        $end = $_POST['end_date'];
                    }else{
                        $end = '2021-12-31';
                    }
                    
                    $status = $_POST['status'];
                    $i = 1;
                    if ($status == 6) {
                        $qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID = s.vendor_ID where po.delivery_date between '$start' and ' $end' order by delivery_date");
                        while ($row = $qry->fetch_assoc()):
                            $row['item_count'] = $conn->query("SELECT * FROM purchase_order_details where po_id = '{$row['id']}'")->num_rows;
                            $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM purchase_order_details where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-left"><?php echo date("d-m-Y", strtotime($row['delivery_date'])); ?></td>
                                <td class="text-left"><?php echo $row['po_no'] ?></td>
                                <td class="text-left"><?php echo $row['sname']?></td>
                                <td class="text-center"><?php echo number_format($row['item_count']) ?></td>
                                <td class="text-right"><?php echo number_format($row['total_amount'], 2) ?></td>
                                <td class="text-center">
                                    <?php
                                    switch ($row['status']) {
                                        case '1':
                                            echo '<span class="badge badge-success text-center">Approved</span>';
                                            break;
                                        case '2':
                                            echo '<span class="badge badge-danger text-center">Rejected</span>';
                                            break;
                                        case '3':
                                            echo '<span class="badge badge-warning text-danger text-center">Cancelled</span>';
                                            break;
                                        case '4':
                                            echo '<span class="badge badge-info text-center">Sent</span>';
                                            break;
                                        case '5':
                                            echo '<span class="badge badge-primary text-center">Completed</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-secondary text-center">Pending</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile;
                    } ?>
                    <?php
                    $qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID = s.vendor_ID where po.delivery_date between '$start' and ' $end' and po.status = '$status' order by po.delivery_date");
                        while ($row = $qry->fetch_assoc()):
                            $row['item_count'] = $conn->query("SELECT * FROM purchase_order_details where po_id = '{$row['id']}'")->num_rows;
                            $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM purchase_order_details where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-left"><?php echo date("d-m-Y", strtotime($row['delivery_date'])); ?></td>
                                <td class="text-left"><?php echo $row['po_no'] ?></td>
                                <td class="text-left"><?php echo $row['sname']?></td>
                                <td class="text-center"><?php echo number_format($row['item_count']) ?></td>
                                <td class="text-right"><?php echo number_format($row['total_amount'], 2) ?></td>
                                <td class="text-center">
                                    <?php
                                    switch ($row['status']) {
                                        case '1':
                                            echo '<span class="badge badge-success text-center">Approved</span>';
                                            break;
                                        case '2':
                                            echo '<span class="badge badge-danger text-center">Rejected</span>';
                                            break;
                                        case '3':
                                            echo '<span class="badge badge-warning text-danger text-center">Cancelled</span>';
                                            break;
                                        case '4':
                                            echo '<span class="badge badge-info text-center">Sent</span>';
                                            break;
                                        case '5':
                                            echo '<span class="badge badge-primary text-center">Completed</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-secondary text-center">Pending</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile;
                    } ?>
            </tbody>
        </table>
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
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this rent permanently?", "delete_rent", [$(this).attr('data-id')])
        })
        $('.view_details').click(function () {
            uni_modal("Reservaton Details", "purchase_orders/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.renew_data').click(function () {
            _conf("Are you sure to renew this rent data?", "renew_rent", [$(this).attr('data-id')]);
        })
        $('.table th,.table td').addClass('px-3 py-2 align-middle')
    })
</script>
