<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b>Reporting</b></h3>    
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="85%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th class="text-center">No.</th>
                            <th>Report Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Purchase Order Details Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_details"><span class="fa fa-eye"></span> View</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Cancelled Purchase Order Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_cancelledPO"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>  
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Purchase Order Outstanding Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_outstanding"> <span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr> 
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Purchase Quotation Comparison Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_quotation"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr> 
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Total Purchase by Vendor Analysis Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_vendor_analysis"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Supplier Performance Rating Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_rating"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Supplier Price Performance Analysis Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_pricePerformance"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Supplier Purchase Summary Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Supplier Approved List</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_approvedSuppliers"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="">Purchase Requisition Report</td>
                            <td align="center">
                                <a class="btn btn-sm btn-flat btn-default" href="?page=report/view_pr"><span class="fa fa-eye"></span> View</a>        
                            </td>
                        </tr>

                        <?php; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
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
        $('.table th,.table td').addClass('align-middle')
        $('.table').dataTable();
    })

</script>
