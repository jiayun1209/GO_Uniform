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
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-default" href="?page=report/report_list">Back</a>
        </div>
    </div>
   
    <div class="card-body" id="out_print">
        <div class="row"><h3 class="card-title">Purchase Order Details Report</h3></div>

        <div class="row">
            <div class="col-9 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-3">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                
            </div>
        </div>
<!--        <div class="card-body">
		<div class="container-fluid">-->
        <!--<div class="container-fluid">-->
        <table class="table table-hover table-striped">
                <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                </colgroup>
                <thead>
                        <tr class="bg-navy disabled">
                                <th>#</th>
                                <th>Date Created</th>
                                <th>PO #</th>
                                <th>Supplier</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                        </tr>
                </thead>
                <tbody>
                        <?php 
                        $i = 1;
                                $qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID order by unix_timestamp(po.date_updated) ");
                                while($row = $qry->fetch_assoc()):
                                        $row['item_count'] = $conn->query("SELECT * FROM purchase_order_details where po_id = '{$row['id']}'")->num_rows;
                                        $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM purchase_order_details where po_id = '{$row['id']}'")->fetch_array()['total'];
                        ?>
                                <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                        <td class=""><?php echo $row['po_no'] ?></td>
                                        <td class=""><?php echo $row['sname'] ?></td>
                                        <td class="text-right"><?php echo number_format($row['item_count']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                        <td>
                                                <?php 
                                                        switch ($row['status']) {
                                                                case '1':
                                                                        echo '<span class="badge badge-success">Approved</span>';
                                                                        break;
                                                                case '2':
                                                                        echo '<span class="badge badge-danger">Rejected</span>';
                                                                        break;
                                                                case '3':
                                                                        echo '<span class="badge badge-warning text-danger">Cancelled</span>';
                                                                        break;
                                                                default:
                                                                        echo '<span class="badge badge-secondary">Pending</span>';
                                                                        break;
                                                        }
                                                ?>
                                        </td>
                                        <td align="center">
                                                 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="?page=purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?page=purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                  </div>
                                        </td>
                                </tr>
                        <?php endwhile; ?>
                </tbody>
        </table>
</div>
</div>
	<!--</div>-->
        
<!--    </div>
</div>-->
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
