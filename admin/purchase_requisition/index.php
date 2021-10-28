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
                        <col width="10%">

                        <col width="10%">
                        <col width="20%">
                        <col width="14%">
                        <col width="10%">
                        <col width="12%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>

                            <th>PR ID </th>
                            <th>Staff ID </th>
                            <th>Item ID</th>
                            <th>Quantity Request </th>
                            <th>Status </th>
                            <th>Date</th>
                            <th>Action</th>
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

                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['quantity_request'] ?></td>

                                <td class="text-center">
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge badge-success">Completed</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Ongoing</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['date_created'] ?></td>

                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['pr_ID'] ?>"><span class="fa fa-info text-primary"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id = "<?php echo $row['pr_ID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="'<?php echo $row['pr_ID'] ?>'"><span class="fa fa-trash text-danger"></span> Delete</a>
                                    </div>
                                </td>
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
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this Purchase Requisition permanently?", "delete_pr", [$(this).attr('data-id')])
        })
        $('#create').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Add New Purchase Requisition", "purchase_requisition/pr_create.php")
        })
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Purchase Requisition's Details", "purchase_requisition/pr_view.php?pr_ID=" + $(this).attr('data-id'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Purchase Requisition's Details", "purchase_requisition/pr_manage.php?pr_ID=" + $(this).attr('data-id'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_pr($pr_ID) {
        console.log($pr_ID);
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/PR.php?f=delete_pr",
            method: "POST",
            data: {pr_ID: $pr_ID},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>