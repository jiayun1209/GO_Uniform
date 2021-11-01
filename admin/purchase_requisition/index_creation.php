<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Purchase Requisition</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" data-id = "" id="create" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create </a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="4%">
                        <col width="8%">

                        <col width="8%">
                        <col width="10%">
                        <col width="18%">
                        <col width="16%">
                        <col width="20%">
                        <col width="16%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>

                            <th>PR ID </th>
                            <th>Staff ID </th>

                            <th>Type </th>
                            <th>Item ID</th>
                            <th>Quantity Request </th>
                            <th>Status </th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $f1 = "00:00:00";
                        $from = date('Y-m-d') . " " . $f1;
                        $t1 = "23:59:59";
                        $to = date('Y-m-d') . " " . $t1;

                        $i = 1;
                        $cnt = 1;


                        $qry = $conn->query("select p.*, i.id, pd.quantity_request from `purchase_requisition` p join `purchase_requisiton_details` pd on p.pr_ID = pd.pr_ID join `inventory` i on pd.item_id = i.id"
                                . " where p.date_created Between '$from' and '$to'");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo htmlentities($cnt++); ?></td>
                                <td><?php echo $row['pr_ID'] ?></td>
                                <td><?php echo $row['staff_ID'] ?></td>

                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['quantity_request'] ?></td>


                                <td class="text-center">
                                    <?php if ($row['status'] == 'completed'): ?>
                                        <span class="badge badge-success">Completed</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Ongoing</span>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo $row['date_created'] ?></td>

                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#create').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Add New Purchase Requisition", "purchase_requisition/pr_creation_staff.php")
        })

        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })

</script>