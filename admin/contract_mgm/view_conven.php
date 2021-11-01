<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `contract` where id = {$_GET['id']} ");
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

    /* Firefox 
    input[type=number] {
        -moz-appearance: textfield;
    }
    [name="tax_percentage"],[name="discount_percentage"]{
        width:5vw;
    }*/
</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo isset($id) ? "Update Contract Details" : "New Contract" ?> </h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-primary" href="?page=contract_mgm/manage_conven&id=<?php echo $id ?>">Edit</a>
            <a class="btn btn-sm btn-flat btn-default" href="?page=contract_mgm">Back</a>
        </div>
    </div>
    <div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-6">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                <h2 class="text-center"><b>VENDOR CONTRACT AGREEMENT</b></h2>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><h3><b>VENDOR</b></p></h3>
                <?php
                $sup_qry = $conn->query("SELECT r.*, s.* FROM `contract` r,`vendor` s where r.vendor_ID  = s.vendor_ID and r.id = '$id'");
                $supplier = $sup_qry->fetch_array();
                ?>
                <div>
                    <h5> <b>  <p class="m-0"><?php echo $supplier['name'] ?></p>
                            <p class="m-0"><?php echo $supplier['company_code'] ?></p></b> </h5> 
                </div>                 
            </div>

            <div class="col-6 row">               
                <div class="col-6">
                    <p  class="m-0"><b>Date Created</b></p>
                    <p><b><?php echo date("Y-m-d", strtotime($date_created)) ?></b></p>
                </div>
            </div>
        </div>
        <br>
        <h6> <p>This Contract dated<b> <?php echo $supplier ['startDate'] ?> </b>is between<b> <?php echo $supplier ['endDate'] ?> </b>hereinafter called “Sponsor” or "Vendor”. </p>

            <p><b> General Terms: </b></p>
            <p>
                A.	Payment will be made in the form of a check or money order for an amount made payable to Vendor and given to Vendor upon the conclusion of the event. 
                B.	Term of payment is for the purpose of room rental and other services (e.g. catering, entertainment, etc.). 
                C.	It is understood and agreed that payment is not and will not be used as a subsidy for alcoholic beverages. 
                D.	Alcoholic beverages should not be provided free of charge or at such drastically reduced prices so as to encourage alcohol misuse. </p>
            <p><b> Licenses and Insurance:  </b></p>
            <p>  A.	Vendor hereby attests to hold all proper establishment licenses issued by the appropriate local and state authority including but not limited to a liquor license. 
                B.	Vendor hereby attests to be properly insured with at least a minimum of $1,000,000 of general liability insurance evidenced by a properly completed certificate of insurance prepared by the insurance provider. 
                C.	Said insurance documents must be made available upon request of Sponsor.</p> </h6>


        <div class="row">
            <div class="col-md-12">
                <STRONG>
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled" style="">
                                <th class="bg-navy disabled text-light px-1 py-2 text-center">Start Date</th>
                                <th class="bg-navy disabled text-light px-1 py-2 text-center">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rfq_qry = $conn->query("SELECT r.*, s.* FROM `contract` r,`vendor` s where r.vendor_ID  = s.vendor_ID and r.vendor_ID != 0 and r.id = '$id'");

                            while ($row = $rfq_qry->fetch_assoc()):
                                ?>
                                <tr class=rfq-item" data-id="">
                                    <td class="align-middle p-2 text-center"><?php echo $row['startDate'] ?></td>
                                    <td class="align-middle p-2 text-center"><?php echo $row['endDate'] ?></td>                             
                                </tr>
                                <?php
                            endwhile;
                            ?>
                        </tbody>

                    </table>
                    <div class="row">
                        <div class="col-6">   
                        <label for="notes" class="control-label">Notes</label>
                        <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                    </div>   
            </div>
        </div>
    </div>

</div>
<table class="d-none" id="item-clone">
    <tr class="rfq-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td> 
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