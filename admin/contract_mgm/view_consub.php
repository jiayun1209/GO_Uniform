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
            <a class="btn btn-sm btn-flat btn-primary" href="?page=contract_mgm/manage_con&id=<?php echo $id ?>">Edit</a>
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
                <h2 class="text-center"><b>SUB CONTRACTOR CONTRACT AGREEMENT</b></h2>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><h3><b>SUB CONTRACTOR</b></p></h3>
                <?php
                $sub_qry = $conn->query("SELECT r.*, s.* FROM `contract` r,`subcontractor` s where r.subcontractor_ID  = s.subcontractor_ID");
                $sub = $sub_qry->fetch_array();
                ?>
                <div>
                    <h5> <b><p class="m-0"><?php echo $sub['name'] ?></p>    
                            <p class="m-0"><?php echo $sub['company_code'] ?></p> 
                            <p class="m-0"><?php echo $sub['email'] ?></p> </b></h5>
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
        <h6> <p>This Sub Contract dated<b> <?php echo $sub ['startDate'] ?> </b>is between<b> <?php echo $sub ['endDate'] ?> </b> The Contractor and the Subcontractor agree as set forth below:
                <b><p> 1.General Conditions.</b></p>
            <p>This Agreement is to be used in conjunction with the Streeter Associates, Inc. General Conditions of the Subcontract Agreement dated September 1, 2007 ("General Conditions"), which General Conditions are incorporated by reference and made a part of this Agreement. 
                Unless otherwise defined herein, capitalized terms shall be used herein as defined in the General Conditions. 
                This Agreement, the General Conditions and other Contract Documents comprise the entire and integrated agreement between the Contractor and Subcontractor superseding prior negotiations, agreements and representations, oral or written. 
                No modification of this Agreement shall be effective unless it is in writing and signed by a duly authorized officer of Contractor, nor may the provisions of this clause be waived except by such a writing. This Agreement shall be binding upon and inure to the benefit of Contractor, Subcontractor, their successors, assigns and legal representatives.</p>
            <b><p>2. Work.</b> </p>
            <p>The Work of this Agreement is as follows:
                See Exhibit A – Scope of Work</p>
            <b><p>  3. Contract Price.</b> </p>
            <p>Contractor shall pay Subcontractor for the satisfactory performance and completion of the Work $ ("Contract Price"). If the Contract Price is based upon Unit Prices, payment shall be made in accordance with the Unit Price Schedule attached hereto. </p>
            <b><p>    4. Commencement and Completion.</b></p>
            <p>  a. The Subcontractor shall commence the Work on .
                b. The Work shall be substantially complete not later than . Time is of the essence in the performance of this Agreement. </p>
        </h6>
        
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
                            $rfq_qry = $conn->query("SELECT r.*, s.* FROM `contract` r,`subcontractor` s where r.subcontractor_ID  = s.subcontractor_ID and r.subcontractor_ID != 0");

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
                            <label for="remarks" class="control-label">Company Sign Here:</label>
                            <img src="uploads/company_sign.PNG" id="remarks" cols="10" rows="4" class="form-control rounded-0"  >
                        </div>
                        <label for="notes" class="control-label">Notes</label>
                        <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                    </div>   
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