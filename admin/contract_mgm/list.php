<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Contract</h3>
        <div class="card-tools">
            <a href="?page=contract_mgm/manage_contract" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="10%">
                        <col width="15%">
                        <col width="25%">
                        <col width="25%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>						
                            <th>Sub Contract ID</th>
                            <th>Vendor ID</th>
                            <th>Staff ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * from `contract` order by (`id`) asc ");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>                                
                                <td ><p class="m-0 truncate-1"><?php echo $row['subcontract_ID'] ?></p></td>
                                <td ><p class="m-0 truncate-1"><?php echo $row['vendor_ID'] ?></p></td>
                                <td ><p class="m-0 truncate-1"><?php echo $row['staff_ID'] ?></p></td>
                                <td ><p class="m-0 truncate-1"><?php echo $row['startDate'] ?></p></td>
                                <td ><p class="m-0 truncate-1"><?php echo $row['endDate'] ?></p></td>
                                <td class="text-center"><img src="<?php echo validate_file($row['file']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="contract_file"></td>                       
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="?page=user/manage_contract&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this User permanently?", "delete_user", [$(this).attr('data-id')])
        })
        $('.table').dataTable();
    })
    function delete_con($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Users.php?f=delete",
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