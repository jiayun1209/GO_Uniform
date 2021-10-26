<?php
if ($_settings->chk_flashdata('success')):
    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<script language="javascript" type="text/javascript">
    var popUpWin = 0;
    function popUpWindow(URLStr, left, top, width, height)
    {
        if (popUpWin)
        {
            if (!popUpWin.closed)
                popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }

</script>
</head>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Material Requisition</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> New</a>
        </div>
    </div>

    <div class="wrapper">
        <div class="container">
            <div class="row">				
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Today Material Requisition</h3>
                            </div>

                            <br />


                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="container-fluid">
                                        <table class="table table-hover table-striped">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="20%">
                                                <col width="30%">
                                                <col width="30%">
                                                <col width="30%">
                                                <col width="20%">
                                                <col width="25%">
                                            </colgroup>
                                            <thead>
                                                <tr class="bg-navy disabled">
                                                    <th>#</th>
                                                    <th>Staff ID </th>
                                                    <th>Description</th>
                                                    <th>Type </th>
                                                    <th>Status </th>
                                                    <th>MR Date</th>
                                                    <th>Action</th>


                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $f1 = "00:00:00";
                                                $from = date('Y-m-d') . " " . $f1;
                                                $t1 = "23:59:59";
                                                $to = date('Y-m-d') . " " . $t1;

                                                $cnt = 1;

                                                $qry = mysqli_query($conn, "select materials_requisition.staff_ID as staffid,materials_requisition.description as description,"
                                                        . "materials_requisition.type as type, materials_requisition.status as status, materials_requisition.date_created as mrdate, "
                                                        . "materials_requisition.mr_ID as id from materials_requisition "
                                                        . "where materials_requisition.date_created Between '$from' and '$to'");

                                                while ($row = $qry->fetch_assoc()):
                                                    $row['description'] = html_entity_decode($row['description']);
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo htmlentities($cnt++); ?></td>
                                                        
                                                        <td><?php echo htmlentities($row['staffid']); ?></td>
                                                        <td title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
                                                        <td><?php echo htmlentities($row['type']); ?></td>
                                                        <td class="text-center">
                                                            <?php if ($row['status'] == 1): ?>
                                                                <span class="badge badge-success">Completed</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-secondary">Ongoing</span>
                                                            <?php endif; ?>
                                                        </td>



                                                        <td><?php echo htmlentities($row['mrdate']); ?></td>





                                                        <td align="center">
                                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                Action
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item view_data" href="javascript:void(0)" data-mr_ID = "<?php echo $row['mr_ID'] ?>"><span class="fa fa-info text-primary"></span> View</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-mr_ID = "<?php echo $row['mr_ID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-mr_ID="<?php echo $row['mr_ID'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this MR permanently?", "delete_mr", [$(this).attr('data-mr_ID')])
        })
        $('#create_new').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Create New MR", "material_requisition/mr_manage.php")
        })
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> MR's Details", "material_requisition/mr_view.php?mr_ID=" + $(this).attr('data-id'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit MR's Details", "material_requisition/mr_manage.php?mr_ID=" + $(this).attr('data-id'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_mr($id) {
        start_loader();
        $.ajax({
            url: base_url + "classes/MR.php?f=delete_mr",
            method: "POST",
            data: {mr_ID: $id},
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
