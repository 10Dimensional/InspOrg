
<?php
/* Set e-mail recipient */
$myemail  = "samantha@lucidagency.com";

/* Check all form inputs using check_input function */
$firstname = check_input($_POST['firstname']);
$lastname  = check_input($_POST['lastname']);
$email    = check_input($_POST['email']);
$subject = "First Dibs Email Notification";
$presentation = check_input($_POST['Presentation']);
$time = check_input($_POST['time']);

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

There has been a new submission:

First name: $firstname
Last Name: $lastname 
E-mail: $email
Presentation: $presentation
Time: $time

";

$headers = 'From: firstdibs@inspirada.com' . "\r\n" .
    'Reply-To: noreply@inspirada.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

/* Send the message using mail() function */
mail($myemail, $subject, $message, $headers);

/* Redirect visitor to the thank you page */
header('Location: /first-dibs-thank');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>