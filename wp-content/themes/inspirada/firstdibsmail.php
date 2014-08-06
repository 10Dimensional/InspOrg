
<?php
/* Set e-mail recipient */
$myemail  = "samantha@lucidagency.com";

/* Check all form inputs using check_input function */
$firstname = check_input($_POST['firstname']);
$lastname  = check_input($_POST['lastname']);
$email    = check_input($_POST['email']);
$subject = "First Dibs Email Notification";
$presentation = check_input(implode(", " , $_POST['presentation']));

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
";

/* Prepare autoresponder subject */
$respond_subject = "Thank You for Registering for First Dibs at Inspirada!";

/* Prepare autoresponder message */
$respond_message = "You've called First Dibs at Inspirada!

Congratulations, you have First Dibs! Our all-day event features a variety of presentations, from the latest designing trends to cooking lessons from a gourmet chef and more summer fun! To see details about all of the presentations and register for more exciting events click here: (http://www.inspirada.com/first-dibs).

Get ready to see our 17 new models, view the home sites and experience Inspirada. See you there!

- Inspirada
";

$headers = 'From: firstdibs@inspirada.com' . "\r\n" .
    'Reply-To: noreply@inspirada.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    





/* Send the message using mail() function */
mail($myemail, $subject, $message, $headers);
mail($email, $respond_subject, $respond_message, $headers);

/* Redirect visitor to the thank you page */
header('Location: /test-thank');
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