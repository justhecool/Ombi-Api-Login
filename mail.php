<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'config.php';
// Instantiation and passing `true` enables exceptions
function email($name,$email){
$mail = new PHPMailer(true);
$api = new Api();
try {
    //Server settings

    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $api->getConfig('host');                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $api->getConfig('email');                     // SMTP username
    $mail->Password   = $api->getConfig('password');                               // SMTP password
$mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('justin@plex-requests.tk', $api->getConfig('name'));
    $mail->addAddress($email, $name);     // Add a recipient
    $mail->addReplyTo($api->getConfig('email'), $api->getConfig('full_name'));
	$mail->addCC($api->getConfig('email'));
    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Submission Request to '.$api->getConfig('name').'\'s Plex Server';
    $mail->Body    = '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Submission Received</title>
    <style media="all" type="text/css">

        @media all {
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }

        @media all {
            .btn-secondary a:hover {
                border-color: #34495e !important;
                color: #34495e !important;
            }
        }

        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] h2 {
                font-size: 22px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] h3 {
                font-size: 16px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }

            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }

            table[class=body] .content {
                padding: 0 !important;
            }

            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class=body] .header {
                margin-bottom: 10px !important;
            }

            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class=body] .btn table {
                width: 100% !important;
            }

            table[class=body] .btn a {
                width: 100% !important;
            }

            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }

            table[class=body] .alert td {
                border-radius: 0 !important;
                padding: 10px !important;
            }

            table[class=body] .span-2,
            table[class=body] .span-3 {
                max-width: none !important;
                width: 100% !important;
            }

            table[class=body] .receipt {
                width: 100% !important;
            }
        }

        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
        }
    </style>
</head>
<body class="" style="font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f6f6f6; margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;" width="100%" bgcolor="#f6f6f6">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto !important; max-width: 580px; padding: 10px; width: 580px;" width="580" valign="top">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START CENTERED WHITE CONTAINER -->
                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$name.'</span>
                <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; border-radius: 3px;" width="100%">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                <tr>
                                    <td align="center">
                                        <img src="'.$api->getConfig('domain').'/images/plex-requests" alt="Plex Requests logo" width="400px" text-align="center" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">I have successfully received your email, please allow me up to a day to add you to my server.</p><p>Be on the lookout for an email from Plex about an Invitation.</p><p>Once accepted, feel free to request movies with your Plex Username (no password necessary!) <a href="'.$api->getConfig('domain').'" target="_blank">here</a><br />~Your Friend, '.$api->getConfig('name').'</p>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div class="footer" style="clear: both; padding-top: 10px; text-align: center; width: 100%;">

                </div>

                <!-- END FOOTER -->
                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
    </tr>
</table>
</body>
</html>';
    $mail->AltBody = 'I have successfully received your request, please allow me up to a day to add you to my server.</p><p>Be on the lookout for an email from Plex about an Invitation. Once accepted, feel free to request movies with your Plex Username (no password necessary!) at '.$api->getConfig('domain').' ~Your Friend, '.$api->getConfig('name').'';

    $mail->send();
    //echo 'Message has been sent';
    return true;
} catch (Exception $e) {
	return $mail->ErrorInfo;
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
