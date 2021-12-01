<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

//Grab variables
$fname = 'fromEmail';
$lname = 'company_address';
$email = 'logo';
$phone = 'company_code';
$message = 'name';

$mpdf = new \Mpdf\Mpdf();

//Creating our PDF
$data = '';
$data .= '<h1>Your Details</h1>';

//Add data
$data .= '<strong>First Name: </strong> <br/>';
$data .= '<strong>Last Name: </strong> <br/>';
$data .= '<strong>Email: </strong> <br/>';
$data .= '<strong>Phone: </strong> <br/>';

//if ($message) {
//    $data .= '<br/><strong>Message</strong><br/>' . $message;
//}

//Write PDF
$mpdf->WriteHTML($data);

//Output to string
$pdf = $mpdf->Output('', 'S');

//Grab enquiry data
$enquirydata = [
    'First Name' => $fname,
    'Last Name' => $lname,
    'Email' => $email,
    'Phone' => $phone,
    'Message' => $message
];

//Run the function
sendEmail($pdf, $enquirydata);

function sendEmail($pdf, $enquirydata) {
    $emailbody = '';
    $emailbody .= '<h1>Email enquiry from ' .$enquirydata['First Name'].'</h1>';
    
    foreach($enquirydata as $title => $data){
        $emailbody .= '<strong>' . $title.'</strong>'.$data.'</br>';
    }    
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = '8c72a9f9c872a0';                     //SMTP username
        $mail->Password = 'b1c5b22a99908b';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //Attachment
        $mail->addStringAttachment($pdf, 'myattachment.pdf');

        //Recipients
        $mail->setFrom('tayjy-wm18@student.tarc.edu.my', 'Mailer');
        $mail->addAddress('tayjy-wm18@student.tarc.edu.my', 'Supplier Name');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Enquiry from '.$enquirydata['First Name'];
        $mail->Body = $emailbody;
        $mail->AltBody = strip_tags($emailbody);

        $mail->send();
        echo '<script>alert("The Purchase Order has been successfully sent to the supplier!")</script>';
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
