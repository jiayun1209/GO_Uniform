<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Subcontractor</h3>
        <div class="card-tools">
            <a href="?page=Subcontractor/manage_subcontractor" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Invite</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="13%">
                        <col width="12%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>ID</th>
                            <th>Subcontractor Name</th>
                            <th>Company Code</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * from `subcontractor` order by (`subcontractor_ID`) asc ");

                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row['subcontractor_ID'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['company_code'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['registration_status'] == 'registered'): ?>
                                    <span class="badge badge-success">Registered</span>
                                    <?php elseif ($row['registration_status'] == 'approved'): ?>
                                    <span class="badge badge-success">Approved</span>
                                    <?php else: ?>
                                    <span class="badge badge-secondary">Invited</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['description'] ?></td>

                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['subcontractor_ID'] ?>"><span class="fa fa-info text-primary"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id = "<?php echo $row['subcontractor_ID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="'<?php echo $row['subcontractor_ID'] ?>'"><span class="fa fa-trash text-danger"></span> Delete</a>
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
            _conf("Are you sure to delete this Subcontractor permanently?", "delete_subcontractor", [$(this).attr('data-id')])
        })
        /*$('#create_new').click(function () {
         uni_modal("<i class='fa fa-plus'></i> Invite Subcontractor", "test/manage_subcontractor.php")
         })*/
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Subcontractor's Details", "subcontractor/view_details.php?subcontractor_ID=" + $(this).attr('data-id'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Subcontractor's Details", "subcontractor/manage_sub.php?subcontractor_ID=" + $(this).attr('data-id'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_subcontractor($id) {
        console.log($id);
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_subcontractor",
            method: "POST",
            data: {id: $id},
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