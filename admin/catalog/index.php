<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Catalog</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Catalog ID</th>
                            <th>Description</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * from `catalog` c");
                        while ($row = $qry->fetch_assoc()):
                            $row['description'] = html_entity_decode($row['description']);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['catalog_ID'] ?></td>
                                <td class='truncate-3' title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
                                <td align="center">
                                    <a class="btn btn-flat btn-primary" href="?page=catalog/category_detail&id=<?php echo $row['id'] ?>" data-id = "<?php echo $row['id'] ?>" >
                                       View</a>
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
            _conf("Are you sure to delete this Catalog permanently?", "delete_catalog", [$(this).attr('data-id')])
        })
        $('#create_new').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Create New Catalog", "catalog/manage_catalog.php")
        })
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Catalog's Details", "catalog/view_details.php?id=" + $(this).attr('data-id'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Catalog's Details", "catalog/manage_catalog.php?id=" + $(this).attr('data-id'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_catalog($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_catalog",
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