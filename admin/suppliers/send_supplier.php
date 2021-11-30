<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<?php
$sup_qry = $conn->query("SELECT v.*,c.* FROM `vendor` v inner join company c on v.company_code = c.company_code where v.`vendor_ID` = '{$vendor_ID}'");
$supplier = $sup_qry->fetch_array();
$comp_name = $_settings->info('company_name');
$comp_add = $_settings->info('company_address');
$comp_img = $_settings->info('logo');
$name = $toEmail = $supplier["name"];
$sup_code = $supplier['company_code'];
$status = $_settings->info('registration_status');
if ($status == '1') {
    $newstatus = "Congratulation, Your application is *Approved*!";
} else {
    $newstatus = "Unfortunately, Your application is *Rejected*!";
}

$prod = $supplier['product'];
$desc = $supplier['description'];

if (isset($_POST['sendMailBtn'])) {
    $fromEmail = $_settings->info('company_email');
    $toEmail = $supplier['email'];


    $to = "$toEmail";
    $subject = "PO";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $fromEmail . '<' . $fromEmail . '>' . "\r\n" . 'Reply-To: ' . $fromEmail . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    $message = '<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport"
					  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<title>Document</title>
			</head>
			<body>
                        <div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Supplier Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0">Company Name: ' . $comp_name . '</p>
                    <p class="m-0">Email address: ' . $fromEmail . '</p>
                    <p class="m-0">Delivery address:' . $comp_add . '</p>
                </div>
            </div>
            <div class="col-6">
                <center><img src="' . $comp_img . '" alt="" height="200px"></center>
                <h2 class="text-center"><b>Supplier Application</b></h2>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><b>Vendor Application Details</b></p>
                <div>
                    <p>Vendor Name     : ' . $name . '</p>
                    <p>Company Code    : ' . $sup_code . '</p>                      
                    <p>Email address   :' . $toEmail . '</p>
                    <p>Product offered :' . $product . ' </p>
                    <p>Description     : ' . $desc . '</p>
                    <p>Registration Status    : ' . $newstatus . '</p>  
                </div>
                <br>
                 <small> Thanks for register this application as supplier to our <b> GO Uniform Sdn Bhd</b> company! </small>
            </div>           
        </div>      
			<br/>
                    Regards<br/>
                  ' . $fromEmail . '
				</div>
			</body>
			</html>';
    $result = @mail($to, $subject, $message, $headers);

    echo '<script>alert("The applicaiton email has been sent successfully to the supplier!")</script>';
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
    <div class="card-header">
        <h3 class="card-title"><b><?php echo isset($id) ? "Supplier Details" : "Review Supplier" ?></b></h3>
        <div class="card-tools">
            <form action="" id="email-form" method="post" class="form-mail">
                <button class="btn btn-sm btn-flat btn-info" id="sendMailBtn" name="sendMailBtn" type="submit"><i class="fa fa-envelope"></i> Confirm to Send</button>
                <a class="btn btn-sm btn-flat btn-default" href="?page=suppliers">Cancel</a>
            </form>
        </div>
    </div>
    <div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0" name="fromEmail" id="fromEmail"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-6">
                <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px"></center>
                <h2 class="text-center"><b>SUPPLIER</b></h2>
            </div>
        </div>
        <br>
        <div class="row mb-2">
            <div class="col-3">
                <p class="m-0"><b>Supplier Details</b></p>
                <?php
                $sup_qry = $conn->query("SELECT v.*,c.* FROM `vendor` v inner join company c on v.company_code = c.company_code where v.`vendor_ID` = '{$vendor_ID}' ");
                $supplier = $sup_qry->fetch_array();
                ?>
                <div>
                    <p class="m-0">Company Code</p>
                    <p class="m-0">Supplier Name</p>                 
                    <p class="m-0">Email</p>
                    <p class="m-0">Address</p>
                    <p class="m-0">Product</p>
                    <p class="m-0">Description</p>
                    <p class="m-0">Registration Status</p> 
                    <br>
                </div>
            </div>
            <div><br>
                <p class="m-0">: <?php echo $supplier['company_code'] ?> </p>
                <p class="m-0">: <?php echo $supplier['name'] ?></p>                 
                <p class="m-0">: <?php echo $supplier['email'] ?></p>
                <p class="m-0">: <?php echo $supplier['address'] ?></p>
                <p class="m-0">: <?php echo $supplier['product'] ?></p>
                <p class="m-0">: <?php echo $supplier['description'] ?></p>
                <p class="m-0">: 
                    <?php
                    if ($supplier['registration_status'] == '1') {
                        echo "Approved";
                    } else if ($supplier['registration_status'] == '0') {
                        echo "Rejected";
                    }
                    ?></p>
                <br>

            </div>
        </div>           
        <small> Thanks for register this application as supplier to our <b> GO Uniform Sdn Bhd</b> company! </small>
        <br>   
    </div>
</div>
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
</script>