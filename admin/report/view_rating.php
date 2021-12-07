<?php
$con = mysqli_connect("localhost", "root", "", "go");
?>
<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `inventory` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    [name="tax_percentage"],[name="discount_percentage"]{
        width:5vw;
    }
</style>
<div class="card card-outline card-info">
    <div class="card-header ml-5 mr-5 mt-3 mb-2">
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-sm btn-flat btn-default" href="?page=report">Back</a>
        </div>
        <form action="" method="post">
            <div class="row">
                <label class="py-2 text-left">Filter by Rating: </label>
                <div class="col-md-3 form-group">
                    <select name="point" id="point" class="text-center form-control">
                        <option value="6">All</option>
                        <option value="0">0 Star</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitBtn" class="btn btn-sm btn-flat btn-primary text-center form-control"><i class="fa fa-search"></i> Search</button>
                </div>                 
            </div>
        </form>
    </div>


    <div class="card-body ml-5 mr-5" id="out_print">
        <div class="row"><h2 class="text-center"><b>SUPPLIER PERFORMANCE RATING REPORT</b></h2></div>

        <div class="row">
            <div class="col-9 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address'). " " .$_settings->info('company_address_1')." ".$_settings->info('company_postcode')." ".$_settings->info('company_city')." Pulau Pinang"?></p>
                </div>
            </div>
            <div class="col-3">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                <br><br>
            </div>
        </div>

        <table class="table table-hover table-striped" id="datatables">
            <colgroup>
                <col width="5%">
                <col width="32%">
                <col width="32%">
                <col width="31%">

            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th class="text-center">No.</th>
                    <th class="text-left">Supplier Name</th>
                    <th class="text-center">Stars Rated for Supplier</th>
                    <th class="text-left">Remarks</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['submitBtn'])) {
                    $point = $_POST['point'];
                    $i = 1;
                    if ($point == 6) {
                        $qry = $conn->query("SELECT s.name as sname, p.point, p.remarks from vendor s, rating_measurement p, rating r where p.performance_ID = r.performance_ID and r.vendor_ID = s.vendor_ID");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-left"><?php echo $row['sname'] ?></td>
                                <td class="text-center"><?php echo $row['point'] ?></td>
                                <td class="text-left"><?php echo $row['remarks'] ?></td>

                            </tr>

                        <?php
                        endwhile;
                    }
                    ?>
                    <?php
                    $qry = $conn->query("SELECT s.name as sname, p.point, p.remarks from vendor s, rating_measurement p, rating r where p.performance_ID = r.performance_ID and r.vendor_ID = s.vendor_ID and p.point = '$point'");
                    while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-left"><?php echo $row['sname'] ?></td>
                            <td class="text-center"><?php echo $row['point'] ?></td>
                            <td class="text-left"><?php echo $row['remarks'] ?></td>

                        </tr>
                    <?php
                    endwhile;
                }
                ?> 
            </tbody>
        </table>
        <div id="piechart" style="width: 900px; height: 500px; margin-left: auto; margin-right: auto;"></div>
    </div>
</div>

<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>
        <td class="align-middle p-0 text-center">
            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
        </td>
        <td class="align-middle p-1">
            <input type="text" class="text-center w-100 border-0" name="unit[]"/>
        </td>
        <td class="align-middle p-1">
            <input type="hidden" name="item_id[]">
            <input type="text" class="text-center w-100 border-0 item_id" required/>
        </td>
        <td class="align-middle p-1 item-description"></td>
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
        </td>
        <td class="align-middle p-1 text-right total-price">0</td>
    </tr>
</table>
<script>
    $(function () {
        $('#print').click(function (e) {
            e.preventDefault();
            start_loader();
            var _h = $('head').clone()
            var _p = $('#out_print').clone()
            var _el = $('<div>')
            _p.find('thead th').attr('style', 'color:black !important')
            _el.append(_h)
            _el.append(_p)

            var nw = window.open("", "", "width=1200,height=950")
            nw.document.write(_el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    end_loader();
                    nw.close()
                }, 300);
            }, 200);
        })
    })
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
        $('.table th,.table td').addClass('px-3 py-2 align-middle')
    })
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Rating Stars', 'Count of Suppliers'],
<?php
$sql = "SELECT count(s.vendor_ID) as vendor_count, p.point from vendor s, rating_measurement p, rating r where p.performance_ID = r.performance_ID and r.vendor_ID = s.vendor_ID group by p.performance_ID";
$fire = mysqli_query($con, $sql);
while ($result = $fire->fetch_assoc()) {
    echo "['" . $result['point'] . "'," . $result['vendor_count'] . "],";
}
?>
        ]);

        var options = {
            title: 'Suppliers Count Based On Rating'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>