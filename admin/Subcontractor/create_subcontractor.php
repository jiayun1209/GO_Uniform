/*<?php
require_once('../../config.php');
if (isset($_GET['vendor_ID']) && $_GET['vendor_ID'] != "") {
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['vendor_ID']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}

if (isset($_POST['sendMailBtn'])) {
    $fromEmail = $_POST['fromEmail'];
    $toEmail = $_POST['toEmail'];
    $subjectName = $_POST['subject'];
    $message = $_POST['message'];

    $to = "$toEmail";
    $subject = "$subjectName";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
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
			<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
				<div class="container">
                 '.$message.'<br/>
                    Regards<br/>
                  '.$fromEmail.'
				</div>
			</body>
			</html>';
    $result = @mail($to, $subject, $message, $headers);

    echo '<script>alert("Email sent successfully !")</script>';
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
</style>
<form action="" id="invite-form" method="post" class="form-invite">
    <div class="form-label-group">
        <label for="inputEmail">From <span style="color: #FF0000">*</span></label>
        <input type="text" name="fromEmail" id="fromEmail" class="form-control"  value="anqing0101@gmail.com" readonly required autofocus>
    </div> <br/>
    <div class="form-label-group">
        <label for="inputEmail">To <span style="color: #FF0000">*</span></label>
        <input type="text" name="toEmail" id="toEmail" class="form-control" placeholder="Email address" required autofocus>
    </div> <br/>
    <label for="inputPassword">Subject <span style="color: #FF0000">*</span></label>
    <div class="form-label-group">
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
    </div><br/>
    <label for="inputPassword">Message <span style="color: #FF0000">*</span></label>
    <div class="form-label-group">
        <textarea  id="message" name="message" class="form-control" placeholder="Message" required ></textarea>
    </div> <br/>
    <button type="submit" name="sendMailBtn" class="btn btn-lg btn-primary btn-block text-uppercase" >Send Email</button>
</form>
