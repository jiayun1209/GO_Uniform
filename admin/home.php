<h1 class="text-dark">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-dark">
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-truck-loading"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Suppliers</span>
                <span class="info-box-number">
                    <?php
                    $vendor = $conn->query("SELECT * FROM vendor")->num_rows;
                    echo number_format($vendor);
                    ?>
                    <?php ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-boxes"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Items</span>
                <span class="info-box-number">
                    <?php
                    $item = $conn->query("SELECT * FROM inventory where `status` =0 ")->num_rows;
                    echo number_format($item);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-gradient-gray elevation-1"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pending PO</span>
                <span class="info-box-number">
                    <?php
                    $po_pending = $conn->query("SELECT * FROM purchase_order where `status` =0 ")->num_rows;
                    echo number_format($po_pending);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Approved PO</span>
                <span class="info-box-number">
                    <?php
                    $po_approved = $conn->query("SELECT * FROM purchase_order where `status` =1 ")->num_rows;
                    echo number_format($po_approved);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Rejected PO</span>
                <span class="info-box-number">
                    <?php
                    $po = $conn->query("SELECT * FROM purchase_order where `status` =2 ")->num_rows;
                    echo number_format($po);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon text-light bg-gradient-warning elevation-1"><i class="fas fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Cancelled PO</span>
                <span class="info-box-number">
                    <?php
                    $po_cancel = $conn->query("SELECT * FROM purchase_order where `status` =3 ")->num_rows;
                    echo number_format($po_cancel);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
     <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-lightblue elevation-1"><i class="fas fa-comments-dollar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total RFQ</span>
                <span class="info-box-number">
                    <?php
                    $rfq = $conn->query("SELECT * FROM rfq")->num_rows;
                    echo number_format($rfq);
                    ?>
                    <?php ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
 <?php if($_settings->userdata('type') == 2): ?>
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-gradient-gray elevation-1"><i class="fas  fa-comments-dollar"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Pending RFQ</span>
            <span class="info-box-number">
                <?php
                $rfq_pending = $conn->query("SELECT * FROM quotation where `status` = 0 ")->num_rows;
                echo number_format($rfq_pending);
                ?>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas  fa-comments-dollar"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Approved RFQ</span>
            <span class="info-box-number">
                <?php
                $rfq_appoved = $conn->query("SELECT * FROM quotation where `status` =1 ")->num_rows;
                echo number_format($rfq_appoved);
                ?>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas  fa-comments-dollar"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Inactive RFQ</span>
            <span class="info-box-number">
                <?php
                $rfq = $conn->query("SELECT * FROM quotation where `status` =2 ")->num_rows;
                echo number_format($rfq);
                ?>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
 <?php endif; ?>
<!-- /.col -->
<div class="container">

</div>
