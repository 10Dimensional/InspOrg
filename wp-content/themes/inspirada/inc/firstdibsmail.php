
<?php
/* Set e-mail recipient */
$myemail  = "inspiradaevents@gmail.com";

/* Check all form inputs using check_input function */
$firstname = check_input($_POST['firstname']);
$lastname  = check_input($_POST['lastname']);
$email    = check_input($_POST['email']);
$subject = "First Dibs Email Notification";
/*$presentation = check_input(implode(", " , $_POST['presentation']));*/

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
";

/* Prepare autoresponder subject */
$respond_subject = "Thank you for signing up for Super Saturday at Inspirada!";

/* Prepare autoresponder message */
$respond_message = "Inspirada is all yours on SUPER SATURDAY!

Thank you for registering for Super Saturday! We look forward to seeing you on 
October 4th at our 2 brand new parks and 18 new home models!

- Inspirada
";

$headers = 'From: supersaturday@inspirada.com' . "\r\n" .
    'Reply-To: noreply@inspirada.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    





/* Send the message using mail() function */
mail($myemail, $subject, $message, $headers);
mail($email, $respond_subject, $respond_message, $headers);

/* Redirect visitor to the thank you page */
header('Location: /super-saturday-thank');
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