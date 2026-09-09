<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| WEBSITE CONFIGURATION
|--------------------------------------------------------------------------
| Change only these values when using this file on another website.
|--------------------------------------------------------------------------
*/

$site_name = 'Forsk Coding School';
$site_url  = 'https://forskcodingschool.com/';

$from_email = 'info@forskcodingschool.com';
$from_name  = 'Forsk Coding School';

$admin_email = 'mygrootacademy@gmail.com';


/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/

$name       = trim($_POST['your-name'] ?? '');
$email      = trim($_POST['your-email'] ?? '');
$phone      = trim($_POST['phone'] ?? '');
$subject    = trim($_POST['your-subject'] ?? '');
$message    = trim($_POST['message'] ?? '');

$page_url   = trim($_POST['page_url'] ?? '');
$post_url   = trim($_POST['post_url'] ?? '');
$page_title = trim($_POST['page_title'] ?? '');


/*
|--------------------------------------------------------------------------
| VALIDATION
|--------------------------------------------------------------------------
*/

if ($name === '' || $email === '' || $phone === '' || $subject === '') {
    exit('Please fill all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Invalid email address.');
}


/*
|--------------------------------------------------------------------------
| SECURITY / SANITIZATION
|--------------------------------------------------------------------------
*/

$name       = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email      = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phone      = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$subject    = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message    = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

$page_url   = htmlspecialchars($page_url, ENT_QUOTES, 'UTF-8');
$post_url   = htmlspecialchars($post_url, ENT_QUOTES, 'UTF-8');
$page_title = htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8');


/*
|--------------------------------------------------------------------------
| SEND EMAIL TO ADMIN
|--------------------------------------------------------------------------
*/

$mail = new PHPMailer(true);

try {

    // SMTP
    $mail->isSMTP();

    /*
    |--------------------------------------------------------------------------
    | SMTP SETTINGS
    |--------------------------------------------------------------------------
    | Replace these with the SMTP settings you already configured.
    |--------------------------------------------------------------------------
    */

    $mail->Host       = 'smtp.forskcodingschool.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $from_email;
    $mail->Password   = 'YOUR_SMTP_PASSWORD';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;


    /*
    |--------------------------------------------------------------------------
    | ADMIN EMAIL
    |--------------------------------------------------------------------------
    */

    $mail->setFrom(
        $from_email,
        $from_name
    );

    $mail->addAddress(
        $admin_email,
        'Forsk Coding School'
    );

    $mail->addReplyTo(
        $email,
        $name
    );


    /*
    |--------------------------------------------------------------------------
    | ADMIN SUBJECT
    |--------------------------------------------------------------------------
    */

    $mail->Subject =
        'New Enquiry Received - ' .
        $subject .
        ' | ' .
        $site_name;


    /*
    |--------------------------------------------------------------------------
    | ADMIN MESSAGE
    |--------------------------------------------------------------------------
    */

    $mail->isHTML(true);

    $mail->Body = '

    <div style="font-family:Arial,Helvetica,sans-serif;
                max-width:700px;
                margin:auto;
                color:#333;
                line-height:1.6;">

        <h2 style="margin-bottom:5px;">
            New Enquiry Received
        </h2>

        <p>
            A new enquiry has been submitted through
            <strong>' . $site_name . '</strong>.
        </p>

        <hr>

        <h3>Lead Details</h3>

        <table cellpadding="8" cellspacing="0" width="100%"
               style="border-collapse:collapse;">

            <tr>
                <td><strong>Name</strong></td>
                <td>' . $name . '</td>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td>' . $email . '</td>
            </tr>

            <tr>
                <td><strong>Phone</strong></td>
                <td>' . $phone . '</td>
            </tr>

            <tr>
                <td><strong>Course / Enquiry</strong></td>
                <td>' . $subject . '</td>
            </tr>

        </table>

        <hr>

        <h3>Message</h3>

        <p>
            ' . nl2br($message) . '
        </p>

        <hr>

        <h3>Page / Source Details</h3>

        <table cellpadding="8" cellspacing="0" width="100%"
               style="border-collapse:collapse;">

            <tr>
                <td><strong>Page Title</strong></td>
                <td>' . $page_title . '</td>
            </tr>

            <tr>
                <td><strong>Page URL</strong></td>
                <td>
                    <a href="' . $page_url . '" target="_blank">
                        ' . $page_url . '
                    </a>
                </td>
            </tr>

            <tr>
                <td><strong>Post URL</strong></td>
                <td>
                    <a href="' . $post_url . '" target="_blank">
                        ' . $post_url . '
                    </a>
                </td>
            </tr>

        </table>

        <hr>

        <p>
            <strong>' . $site_name . '</strong><br>
            <a href="' . $site_url . '">' . $site_url . '</a>
        </p>

    </div>
    ';


    /*
    |--------------------------------------------------------------------------
    | PLAIN TEXT VERSION
    |--------------------------------------------------------------------------
    */

    $mail->AltBody =
        "New Enquiry Received\n\n" .
        "Name: $name\n" .
        "Email: $email\n" .
        "Phone: $phone\n" .
        "Course / Enquiry: $subject\n\n" .
        "Message:\n$message\n\n" .
        "Page Title: $page_title\n" .
        "Page URL: $page_url\n" .
        "Post URL: $post_url\n";


    /*
    |--------------------------------------------------------------------------
    | SEND ADMIN EMAIL
    |--------------------------------------------------------------------------
    */

    $mail->send();


    /*
    |--------------------------------------------------------------------------
    | USER CONFIRMATION EMAIL
    |--------------------------------------------------------------------------
    */

    $userMail = new PHPMailer(true);

    $userMail->isSMTP();

    $userMail->Host       = 'smtp.hostinger.com';
    $userMail->SMTPAuth   = true;
    $userMail->Username   = $from_email;
    $userMail->Password   = 'HareRam@987#45';

    $userMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $userMail->Port       = 465;


    $userMail->setFrom(
        $from_email,
        $from_name
    );

    $userMail->addAddress(
        $email,
        $name
    );

    $userMail->addReplyTo(
        $from_email,
        $from_name
    );


    /*
    |--------------------------------------------------------------------------
    | USER EMAIL SUBJECT
    |--------------------------------------------------------------------------
    */

    $userMail->Subject =
        'Thank You for Contacting ' .
        $site_name;


    /*
    |--------------------------------------------------------------------------
    | USER EMAIL BODY
    |--------------------------------------------------------------------------
    */

    $userMail->isHTML(true);

    $userMail->Body = '

    <div style="font-family:Arial,Helvetica,sans-serif;
                max-width:700px;
                margin:auto;
                color:#333;
                line-height:1.6;">

        <h2>Thank You for Contacting ' . $site_name . '</h2>

        <p>
            Hello <strong>' . $name . '</strong>,
        </p>

        <p>
            Thank you for contacting
            <strong>' . $site_name . '</strong>.
        </p>

        <p>
            We have successfully received your enquiry.
            Our team will get in touch with you shortly.
        </p>

        <hr>

        <h3>Your Enquiry Details</h3>

        <table cellpadding="8" cellspacing="0" width="100%"
               style="border-collapse:collapse;">

            <tr>
                <td><strong>Name</strong></td>
                <td>' . $name . '</td>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td>' . $email . '</td>
            </tr>

            <tr>
                <td><strong>Phone</strong></td>
                <td>' . $phone . '</td>
            </tr>

            <tr>
                <td><strong>Course / Enquiry</strong></td>
                <td>' . $subject . '</td>
            </tr>

        </table>

        <h3>Your Message</h3>

        <p>
            ' . nl2br($message) . '
        </p>

        <hr>

        <h3>Explore ' . $site_name . '</h3>

        <p>
            <a href="' . $site_url . '">
                Visit Website
            </a>
        </p>

        <p>
            <a href="' . $site_url . 'courses/">
                Explore Courses
            </a>
        </p>

        <p>
            <a href="' . $site_url . 'contact-us/">
                Contact Us
            </a>
        </p>

        <hr>

        <p>
            Regards,<br>
            <strong>' . $site_name . '</strong>
        </p>

        <p>
            Website:
            <a href="' . $site_url . '">' . $site_url . '</a>
        </p>

        <p>
            Email:
            <a href="mailto:' . $from_email . '">
                ' . $from_email . '
            </a>
        </p>

    </div>
    ';


    /*
    |--------------------------------------------------------------------------
    | SEND USER EMAIL
    |--------------------------------------------------------------------------
    */

    $userMail->send();


    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    header('Location: thank-you.html');
    exit;


} catch (Exception $e) {

    echo 'Message could not be sent. Please try again later.';

}
?>