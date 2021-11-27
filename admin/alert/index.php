<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Alert</h3>
        
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>

                        <col width="5%">
                        
                        <col width="15%">
                        <col width="30%">
                        <col width="25%">
                        <col width="5%">
                        <col width="5%">
                        <col width="15">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>No</th>
                            
                            <th>Alert Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Viewed</th>
                            <th>User ID</th>
                            <th>Date Created</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $cnt = 1;
                        $qry = $conn->query("SELECT * from `alert` order by (`alert_id`) asc ");
                        $statusArr = ["Pending", "Approved", "Rejected"];
                        
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>

                                <td class="text-center"><?php echo htmlentities($cnt++); ?></td>
                                
                                <td><a href="<?php echo $row['url']?>"><?php echo $row['alert_name'] ?></a></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $statusArr[$row['type']-1] ?></td>
                                <td><?php echo $row['viewed'] ?></td>
                                <td><?php echo $row['userID'] ?></td>
                                <td class=""><?php echo $row['date_alert'] ?></td>
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
            _conf("Are you sure to delete this Alert permanently?", "delete_alert", [$(this).attr('data-id')])
        })
        $('#create_new').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Create New Alert", "alert/create_alert.php")
        })
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Alert Details", "alert/view_alert.php?alert_id=" + $(this).attr('data-id'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Alert Details", "alert/manage_alert.php?alert_id=" + $(this).attr('data-id'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_alert($alert_id) {
        console.log($alert_id);
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_alert",
            method: "POST",
            data: {alert_id: $alert_id},
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
