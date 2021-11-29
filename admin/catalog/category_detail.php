<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM catalog WHERE id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            echo '<script>var current_data = ' . json_encode($current_data) . ';</script>';
            break;
        }
    } else {
        echo '<script>alert("Extract data error !\nContact IT department to maintainence");window.location.href = "category_list.php";</script>';
    }
} else {
    echo '<script>var current_data = null;</script>';

    /*$sql = "SELECT id FROM catalog ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $latestnum = ((int) substr($row['id'], 1)) + 1;
            if ($latestnum < 10) {
                $newid = "1000{$latestnum}";
            } else if ($latestnum < 100) {
                $newid = "100{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "10{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "1{$latestnum}";
            }
            break;
        }
    }*/
}
?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of items that related to this category</h3>
        <div class="card-tools">
            <h3 class="card-title">Catalog ID : <?php
                if (isset($current_data)) {
                    echo $current_data["catalog_ID"];
                } else {
                    echo "(New)" . $newid;
                }
                ?></h3>
            <br>
            <h4 class="card-title">Catalog Name : <?php
                if (isset($current_data)) {
                    echo $current_data["description"];
                } else {
                    echo "(New)" . $newid;
                }
                ?></h4>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Vendor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT i.*,v.name as vname FROM inventory i inner join vendor v on v.vendor_ID = i.vendor_ID WHERE catalog_ID = '" . $current_data["id"] . "'");
                        while ($row = $qry->fetch_assoc()):
                            $row['description'] = html_entity_decode($row['description']);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                <td><?php echo $row['item_code'] ?></td>

                                <td><?php echo $row['name'] ?></td>
                                <td class='text-left' title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
                                <td><?php echo $row['vname'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="?page=catalog/product_detail&id=<?php echo $row['id'] ?>" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="?page=catalog/category_detail&id=<?php echo $row['id'] ?>" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>                    </tbody>
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