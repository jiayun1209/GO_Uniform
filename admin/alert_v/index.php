<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Alert</h3>
        <div class="card-tools">
            
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>

                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="35%">
                        <col width="25%">
                        
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>No</th>
                            <th>Alert ID</th>
                            <th>Alert Name</th>
                            <th>Description</th>
                            <th>Date Created</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $cnt = 1;
                        $qry = $conn->query("SELECT * from `alert` order by (`alert_id`) asc ");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>

                                <td class="text-center"><?php echo htmlentities($cnt++); ?></td>
                                <td><?php echo $row['alert_id'] ?></td>
                                <td><?php echo $row['alert_name'] ?></td>
                                <td><?php echo $row['description'] ?></td>
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
