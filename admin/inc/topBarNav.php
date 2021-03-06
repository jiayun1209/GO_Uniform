<style>
    .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
    }
    .btn-rounded{
        border-radius: 50px;
    }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light border border-light shadow  border-top-0  border-left-0 border-right-0 navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php if ($_settings->userdata('type') == 1): ?>
                <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Admin</a>
            <?php endif; ?>
            <?php if ($_settings->userdata('type') == 2): ?>
                <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Manager</a>
            <?php endif; ?>
            <?php if ($_settings->userdata('type') == 3): ?>
                <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Staff</a>
            <?php endif; ?>
            <?php if ($_settings->userdata('type') == 4): ?>
                <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Branches</a>
            <?php endif; ?>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">

            <div class="btn-group nav-link" style="padding: 0.35rem 0rem;">
                <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                    <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                </div>
                <!-- <button type="image" name="Alert Icon" 
            <img src="C:\xampp\htdocs\GO_Uniform\uploads\alerticon" alt="Alert Icon" class="brand-image img-circle elevation-3 bg-light" style="width: 1.75rem;height: 1.75rem;max-height: unset">
        </button> -->
            </div>
        </li>
        <li class="nav-item nav-item-alert">
            <span style="display: inline-block;margin-right: 1em;">
                <a class="btn" data-toggle="collapse" href="#alert" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-bell" style="color: #666"></i>
                </a>
                <span class="alert-count">
                    0
                </span>
            </span>
            <div class="collapse" id="alert" style=" position: absolute; right: 1em; ">
                <div class="card card-body">
                    I am alert message
                </div>
            </div>
        </li>
        <!--  <li class="nav-item">
           <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
           <i class="fas fa-th-large"></i>
           </a>
         </li> -->
    </ul>
</nav>

<script>
    $(function () {
        $.ajax({
            url: "api/alert/getList.php",
            type: "get",
            success: function (response) {
                if (response != -1) {
                    var alertList = response;
                    var alertHtml = alertList.map(function (alertItem) {
                        return `<div class="alert-item">
                                                    <div class="title">
                                                        <a href="${alertItem.url}">${alertItem.alert_name}</a>
                                                    </div>
                                                    <div class="message">
                                                        ${alertItem.description}
                                                    </div>
                                                </div>`;
                    });
                    $("#alert").find(".card-body").html(alertHtml);
                    $(".nav-item-alert").find(".alert-count").text(alertList.length);

                    OverlayScrollbars($("#alert").find(".card-body")[0]);
                }
            }
        });



    })
</script>
<!-- /.navbar -->