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
    </div>


    <div class="card-body ml-5 mr-5" id="out_print">
        <div class="row"><h2 class="text-center"><b>SUPPLIER APPROVED LIST</b></h2></div>

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

        <table class="table table-hover table-striped">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="20%">
                <col width="20%">
            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th class="px-1 py-1 text-center">No.</th>
                    <th class="px-1 py-1 text-left">Company</th>
                    <th class="px-1 py-1 text-left">Supplier Name</th>
                    <th class="px-1 py-1 text-left">Email Address</th>
                    <th class="px-1 py-1 text-left">Products Offered</th>
                    <th class="px-1 py-1 text-left">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT c.*, s.* FROM `company` c inner join `vendor` s on s.company_code  = c.company_code where `registration_status` =1");
                while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class=""><?php echo ($row['company_code']) . " - " . ($row['company_name']); ?></td>
                        <td class=""><?php echo $row['name'] ?></td>
                        <td class="text-left"><?php echo $row['email'] ?></td>
                        <td class="text-left"><?php echo $row['product'] ?></td>
                        <td class="text-left"><?php echo $row['description'] ?></td>
                    </tr>
                <?php endwhile; ?>
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
