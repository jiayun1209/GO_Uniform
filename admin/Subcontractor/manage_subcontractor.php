<?php
if (isset($_POST['sendMailBtn'])) {
    require_once '../classes/DBConnection.php';
    $fromEmail = $_POST['fromEmail'];
    $toEmail = $_POST['toEmail'];
    $toName = $_POST['toName'];
    $subjectName = $_POST['subject'];
    $message = $_POST['message'];
    $message1 = $_POST['message'];
    $messages = "$message1";

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
                                Hello, '.$toName.' <br/>
                 '.$message.'<br/>
                    Regards<br/>
                  '.$fromEmail.'
				</div>
			</body>
			</html>';
    $result = @mail($to, $subject, $message, $headers);
    $company_code = "Random-" . (sprintf("%'.011d", mt_rand(1, 99999999999)));
    $name = "$toName";
    $address = "Update when company registered !";
    $currency = "Update when company registered !";
    $language = "Update when company registered !";
    $company_name = $_POST['toCName'];
    $registration_status = "invited";
    $query = mysqli_query($conn, "insert into company(company_code,company_name,address,currency,language) values('$company_code','$company_name','$address','$currency','$language')");
    $query2 = mysqli_query($conn, "insert into subcontractor(name,company_code,email,registration_status,description) values('$name','$company_code','$to','$registration_status','$messages')"); 
    if ($query && $query2){
        echo "<script>alert('You are successfully invited');</script>";
        echo '<script>alert("Email sent successfully !")</script>';
    } else {
        echo "<script>alert('Not invited something went worng');</script>";
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
</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Outsourcing : Invite</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-flat btn-default" href="?page=subcontractor">Back</a>
        </div>
    </div>
<form action="" id="invite-form" method="post" class="form-invite">
    <div class="form-label-group">
        <label for="inputEmail">From <span style="color: #FF0000">*</span></label>
        <input type="text" name="fromEmail" id="fromEmail" class="form-control"  value="anqing0101@gmail.com" readonly required autofocus>
    </div> <br/>
    <div class="form-label-group">
        <label for="inputEmail">Email <span style="color: #FF0000">*</span></label>
        <input type="text" name="toEmail" id="toEmail" class="form-control" placeholder="Email address" required autofocus>
    </div> <br/>
     <div class="form-label-group">
        <label for="inputCName">Company <span style="color: #FF0000">*</span></label>
        <input type="text" name="toCName" id="toCName" class="form-control" placeholder="Company Name" required autofocus>
    </div> <br/>
    <div class="form-label-group">
        <label for="inputName">To <span style="color: #FF0000">*</span></label>
        <input type="text" name="toName" id="toName" class="form-control" placeholder="Name" required autofocus>
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
 