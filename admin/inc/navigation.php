<?php
$stmt = $conn->query("SELECT * FROM general_setting where meta_field ='theme_colour'");
$backgroundColor = $stmt->fetch_array()["meta_value"];
?>

<style>

    .main-sidebar.bg-navy{
        background-color: #<?php echo $backgroundColor; ?> !important;
    }

    .main-sidebar .brand-link{
        background-color: rgba(171,171,171, 0.63) !important;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-secondary bg-navy elevation-4 sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-secondary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-light" style="width: 2.05rem;height: 2.05rem;max-height: unset">
        <span class="brand-text font-weight-normal text-md"><?php echo $_settings->info('short_name') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden bg-dark" style="background-color: #<?php echo $backgroundColor ?> !important">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="clearfix"></div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-4">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item dropdown">
                                <a href="./" class="nav-link nav-home">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li> 

                            <?php if ($_settings->userdata('type') == 4): ?>
                                <li class="nav-header"><b>Purchase Needs Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=purchase_r" class="nav-link nav-purchase_r">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Purchase Requisition
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=material_r" class="nav-link nav-material_r">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Material Requisition  
                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($_settings->userdata('type') == 2): ?>
                                <li class="nav-header"><b>Purchase Needs Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=purchase_m" class="nav-link nav-purchase_m">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Purchase Requisition
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=material_m" class="nav-link nav-material_m">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Material Requisition  
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>Sourcing Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=catalog" class="nav-link nav-catalog">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>
                                            Manage Catalog
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=category" class="nav-link nav-catalog">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>
                                            Manage Category
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-header"><b>Supplier Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=suppliers" class="nav-link nav-suppliers">
                                        <i class="nav-icon fas fa-truck-loading"></i>
                                        <p>
                                            Approving Suppliers   
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=Subcontractor" class="nav-link nav-Subcontractor">
                                        <i class="nav-icon fas fa-truck-loading"></i>
                                        <p>
                                            Manage Subcontractor   
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=contract_mgm" class="nav-link nav-contract_mgm">
                                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                        <p>
                                            Manage Contract
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>PO Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=purchase_orders" class="nav-link nav-purchase_orders">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Purchase Orders
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>Reporting</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>
                                            Generate Reports
                                        </p>
                                    </a>
                                </li>

                            <?php endif; ?>

                            <?php if ($_settings->userdata('type') == 1): ?>

                                <li class="nav-header"><b>System Initialization</b></li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>
                                            User Company Details
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=setting" class="nav-link nav-">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            General Settings
                                        </p>
                                    </a>
                                </li>
                                 <li class="nav-item dropdown">
                                    <a href="http://localhost/GO_Uniform/admin/operation_calendar/index.php"  class="nav-link nav-">
                                        <i class="nav-icon fas fa-calendar"></i>
                                        <p>
                                            Operation Calendar 
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>Setups</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Staff Maintenance
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=suppliers" class="nav-link nav-suppliers">
                                        <i class="nav-icon fas fa-truck-loading"></i>
                                        <p>
                                            Supplier Maintenance   
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=subcontractor" class="nav-link nav-subcontractor">
                                        <i class="nav-icon fas fa-truck-loading"></i>
                                        <p>
                                            Subcontractor Maintenance   
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=items" class="nav-link nav-items">
                                        <i class="nav-icon fas fa-boxes"></i>
                                        <p>
                                            Inventory
                                        </p>
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=manage_event" class="nav-link nav-manage_event">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>
                                            Operation Calendar
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>Procurement Organization</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=budget" class="nav-link nav-budget">
                                        <i class="nav-icon fas fa-dollar-sign"></i>
                                        <p>
                                            Set Purchase Budget
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-header"><b>Alert Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=alert" class="nav-link nav-alert_v">
                                        <i class="nav-icon fas fa-bell"></i>
                                        <p>
                                            Manage Alert Settings
                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($_settings->userdata('type') == 3): ?>
                                <li class="nav-header"><b>Sourcing Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=suppliers" class="nav-link nav-suppliers">
                                        <i class="nav-icon fas fa-truck-loading"></i>
                                        <p>
                                            Invite Suppliers   
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=subcontractor" class="nav-link nav-subcontractor">
                                        <i class="nav-icon fas fa-people-carry"></i>
                                        <p>
                                            Subcontractor
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=catalog" class="nav-link nav-catalog">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>
                                            Manage Catalog
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>Supplier Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=RFQ" class="nav-link nav-RFQ">
                                        <i class="nav-icon fas fa-comments-dollar"></i>
                                        <p>
                                            Request for Quotation   
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=Quotation" class="nav-link nav-Quotation">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Maintain Quotation   
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=rating" class="nav-link nav-rating">
                                        <i class="nav-icon fas fa-star-half-alt"></i>
                                        <p>
                                            Rating Measurement
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header"><b>PO Management</b></li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>admin/?page=purchase_orders" class="nav-link nav-purchase_orders">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Purchase Orders
                                        </p>
                                    </a>
                                </li>

                            <?php endif; ?>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    $(document).ready(function () {
        var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
        var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
        page = page.split('/');
        page = page[0];
        if (s != '')
            page = page + '_' + s;

        if ($('.nav-link.nav-' + page).length > 0) {
            $('.nav-link.nav-' + page).addClass('active')
            if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
                $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
                $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
            }
            if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
                $('.nav-link.nav-' + page).parent().addClass('menu-open')
            }

        }

    })
</script>
