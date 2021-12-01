<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT po.*, s.* from `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

//Grab variables
$sup_qry = $conn->query("SELECT p.*, s.* from `purchase_order` p inner join `vendor` s on p.vendor_ID  = s.vendor_ID where id = '{$id}'");
$supplier = $sup_qry->fetch_array();
$comp_name = $_settings->info('company_name');
$comp_add = $_settings->info('company_address');
$name = $supplier["name"];
$toEmail = $supplier['email'];
$fromEmail = $_settings->info('company_email');
$date2 = date("d-m-Y", strtotime($delivery_date));
$poNum = $supplier['po_no'];

//Grab enquiry data
$enquirydata = [
    'cname' => $comp_name,
    'cadd' => $comp_add,
    'To' => $toEmail,
    'From' => $fromEmail,
    'sname' => $name,
    'deliveryDate' => $date2,
    'poNo' => $poNum
];

//Run the function
sendEmail($enquirydata);

function sendEmail($enquirydata) {
    $emailbody = '';
    $emailbody .= '<h1>Reminder Email From ' .$enquirydata['cname'].'</h1>';
    
    $emailbody .= '</br></br>Hi supplier '.$enquirydata['sname'].', this is to remind you that the PO required date is just around the corner.';
    $emailbody .= '</br></br>The delivery date for this PO ('.$enquirydata['poNo'].') is near, which is on '.$enquirydata['deliveryDate'];
    $emailbody .= '</br></br>Hence, this email is for reminding you to remind you so that the goods can be delivered on time.';
    $emailbody .= '</br></br>Thank you.';
    $emailbody .= '</br></br></br></br>Regards,';
    $emailbody .= '</br>'.$enquirydata['cname'];
    $emailbody .= '</br>'.$enquirydata['cadd'];
    $emailbody .= '</br>For any enquires, please contact: '.$enquirydata['From'];
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

        //Recipients
        $mail->setFrom($enquirydata['From'], $enquirydata['cname']);
        $mail->addAddress($enquirydata['To'], $enquirydata['sname']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reminder Email From '.$enquirydata['cname'];
        $mail->Body = $emailbody;
        $mail->AltBody = strip_tags($emailbody);

        $mail->send();
        echo '<script>alert("Your reminder email has been successfully sent to the supplier!")</script>';
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
