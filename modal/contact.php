<?php

// Put contacting email here
$php_main_email = "ngoduykhanh2001@gmail.com";

//Fetching Values from URL
$php_name = $_POST['ajax_name'];
$php_email = $_POST['ajax_email'];
$php_message = $_POST['ajax_message'];



//Sanitizing email
// $php_email = filter_var($php_email, FILTER_SANITIZE_EMAIL);


// //After sanitization Validation is performed
// if (filter_var($php_email, FILTER_VALIDATE_EMAIL)) {


// 	$php_subject = "Message from contact form";

// 	// To send HTML mail, the Content-type header must be set
// 	$php_headers = 'MIME-Version: 1.0' . "\r\n";
// 	$php_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// 	$php_headers .= 'From:' . $php_email . "\r\n"; // Sender's Email
// 	$php_headers .= 'Cc:' . $php_email . "\r\n"; // Carbon copy to Sender

// 	$php_template = '<div style="padding:50px;">Hello ' . $php_name . ',<br/>'
// 		. 'Thank you for contacting us.<br/><br/>'
// 		. '<strong style="color:#f00a77;">Name:</strong>  ' . $php_name . '<br/>'
// 		. '<strong style="color:#f00a77;">Email:</strong>  ' . $php_email . '<br/>'
// 		. '<strong style="color:#f00a77;">Message:</strong>  ' . $php_message . '<br/><br/>'
// 		. 'This is a Contact Confirmation mail.'
// 		. '<br/>'
// 		. 'We will contact you as soon as possible .</div>';
// 	$php_sendmessage = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";

// 	// message lines should not exceed 70 characters (PHP rule), so wrap it
// 	$php_sendmessage = wordwrap($php_sendmessage, 70);

// 	// Send mail by PHP Mail Function
// 	mail($php_main_email, $php_subject, $php_sendmessage, $php_headers);
// 	echo "";
// } else {
// 	echo "<span class='contact_error'>* Invalid email *</span>";
// }


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = false;
	$mail->isSMTP();
	$mail->Host       = 'smtp.gmail.com;';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'ngoduykhanh2001@gmail.com';
	$mail->Password   = 'cbukfmstfoqnuyan';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	$mail->Port       = 587;
	$mail->CharSet  = "utf-8";
	$mail->setFrom($php_main_email, 'Duy Khanh');
	$mail->addReplyTo('ngoduykhanh2001@gmail.com', 'Duy Khanh');
	$mail->addAddress($php_email);

	$mail->isHTML(true);
	$mail->Subject = 'Message from contact form';
	$php_template = '<div style="padding:50px;line-height:25px;">Hello ' . $php_name . ',<br/>'
		. 'Thank you for contacting me.<br/><br/>'
		. '<strong style="color:#f00a77;">Name:</strong>  ' . $php_name . '<br/>'
		. '<strong style="color:#f00a77;">Email:</strong>  ' . $php_email . '<br/>'
		. '<strong style="color:#f00a77;">Message:</strong>  ' . $php_message . '<br/><br/>'
		. 'This is a Contact Confirmation mail.'
		. '<br/>'
		. 'We will contact you as soon as possible .</div>';
	$mail->Body    = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	if ($mail->send()) {
		echo '';
	} else {
		echo 'Lỗi. Thư chưa gửi được';
	}
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
