<?php
//index.php

$cv_error = '';
$cv_success='';
$first_name = '';
$last_name = '';
$email = '';
$phone = '';
$year = '';
$salary = '';
$message = '';
$portfolio = '';
$company = '';
$position = '';
$cv = '';


function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["career_submit"]))
{
    if(empty($_POST["first_name"]))
    {
        $cv_error .= '<p><label class="text-danger">Please Enter your First Name</label></p>';
    }
    else
    {
        $first_name = clean_text($_POST["first_name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$first_name))
        {
            $cv_error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
        }
    }

    if(empty($_POST["last_name"]))
    {
        $cv_error .= '<p><label class="text-danger">Please Enter your Last Name</label></p>';
    }
    else
    {
        $last_name = clean_text($_POST["last_name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$last_name))
        {
            $cv_error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
        }
    }

    if(empty($_POST["email"]))
    {
        $cv_error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
    }
    else
    {
        $email = clean_text($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $cv_error .= '<p><label class="text-danger">Invalid email format</label></p>';
        }
    }
    if(empty($_POST["phone_number"]))
    {
        $cv_error .= '<p><label class="text-danger">Phone is required</label></p>';
    }
    else
    {
        $phone = clean_text($_POST["phone_number"]);
    }
    if(empty($_POST["year"]))
    {
        $cv_error .= '<p><label class="text-danger">Year is required</label></p>';
    }
    else
    {
        $year = clean_text($_POST["year"]);
    }
    if(empty($_POST["salary"]))
    {
        $cv_error .= '<p><label class="text-danger">Salary is required</label></p>';
    }
    else
    {
        $salary = clean_text($_POST["salary"]);
    }
    if(empty($_POST["message"]))
    {
        $cv_error .= '<p><label class="text-danger">Message is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["message"]);
    }
//    if(empty($_POST["portfolio_link"]))
//    {
//        $cv_error .= '<p><label class="text-danger">Message is required</label></p>';
//    }
//    else
//    {
//        $portfolio = clean_text($_POST["portfolio_link"]);
//    }
    if(empty($_POST["apply_position"]))
    {
        $cv_error .= '<p><label class="text-danger">Position is required</label></p>';
    }
    else
    {
        $position = clean_text($_POST["apply_position"]);
    }

    if($cv_error == '')
    {
        require 'class/class.phpmailer.php';

        $uploaddir = 'uploads/';
        $uploadfile = $uploaddir . basename($_FILES['cv_upload_document']['name']);

        if (move_uploaded_file($_FILES['cv_upload_document']['tmp_name'], $uploadfile)) {
            echo "upload successful";
        } else {
            echo "Possible invalid file upload !\n";
        }
        $mail = new PHPMailer;
        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.feits.co';  //Sets the SMTP hosts
        $mail->Port = '465';        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'web@feits.co';     //Sets SMTP username/gmail
        $mail->Password = 'web@feits';     //Sets SMTP password
        $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = $_POST["email"];     //Sets the From email address for the message
        $mail->FromName = $_POST["first_name"];    //Sets the From name of the message
        $mail->AddAddress('web@feits.co', 'web@feits.co');//Adds a "To" address
        $mail->AddCC($_POST["email"], $_POST["first_name"]); //Adds a "Cc" address
        $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);       //Sets message type to HTML
        $mail->Subject = $_POST["apply_position"];    //Sets the Subject of the message
        $mail->AddAttachment($uploadfile);
        $mail->Body ='<h4>User Request from feits.co website</h4>'.'<br>'.'First Name:'.$_POST["first_name"].'<br>'.'Last Name:'.$_POST['last_name'].'<br>'.'Email:'.$_POST["email"].'<br>'.'Mobile:'.$_POST["phone_number"].'<br>'.'Experience:'.$_POST["year"].'<br>'.'Salary Expectation:'.$_POST["salary"].'<br>'.'Message:'.$_POST["message"].'<br>'.'Portfolio:'.$_POST['portfolio_link'].'<br>'.'Position:'.$_POST['apply_position'];    //An HTML or plain text message body
        if($mail->Send())        //Send an Email. Return true on success or false on error
        {
            $cv_success = '<label class="text-success">Thank you for contacting us</label>';
        }
        else
        {
            $cv_error = '<label class="text-danger">There is an Error</label>';
        }
        $cv_error = '';
        $cv_success='';
        $first_name = '';
        $last_name = '';
        $email = '';
        $phone = '';
        $year = '';
        $salary = '';
        $message = '';
        $portfolio = '';
        $company = '';
        $position = '';
        $cv = '';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Career Form</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <link id="favicon" rel="shortcut icon"  href="images/ico.png" type="image/x-icon">

    <link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.3.1.min.js"></script>



</head>
<body>
<div class="main">
    <!-- <h1>Apply Form Now</h1> -->
    <div class="w3_agile_main_grids">
        <div class="agileits_w3layouts_main_grid">
            <!-- <h1 class="apply-heading">Apply Form Now</h1> -->
            <?php echo $cv_success; ?>
            <?php echo $cv_error; ?>
            <form  method="post" enctype="multipart/form-data">
                <div class="agile_main_grid_left">
                    <div class="w3_agileits_main_grid_left_grid">
                        <!-- <h3>Register Here :</h3> -->
                        <h3>Apply Form Now</h3>
                        <input type="text" name="first_name" placeholder="First Name">
                        <input type="email" name="email" placeholder="Email" id="email">
                        <input type="text" name="year"  placeholder="Years Of Experience">
                        <textarea name="message" placeholder="Why You Want To Join FEITS..."  id="message"></textarea>
                        
                        <select name="apply_position" class="form-control position_select">
                            <option value="">Choose Your Position.....</option>
                            <option value="Software Engineer(Laravel)">Software Engineer(Laravel)</option>
                            <option value="HR Officer">HR Officer</option>
                            <option value="Marketing Executive">Marketing Executive</option>
                         </select>
                    </div>
                </div>
                <div class="agile_main_grid_left">
                    <!-- <h3>Your Details :</h3> -->
                    <input type="text" name="last_name" placeholder="Last Name"  id="last_name">
                    <input type="text" name="phone_number" placeholder="Phone Number"  id="phone_number">
                    <input type="text" name="salary" placeholder="Salary Expectation" id="salary">
                    <input type="text" name="portfolio_link" placeholder="Portfolio Link (Optional)" id="portfolio_link">

<!--                    <input type="text" name="position" placeholder="Position" id="position">-->

                    

                    <div class="w3layouts_file_upload">
                        <div id="messages">
                            <h4>Upload CV Here</h4>
                        </div>
                        <div class="w3_agileinfo_file">
                            <input type="file"  name="cv_upload_document" />
                        </div>

                    </div>
                </div>
                <div class="clear"> </div>
                <input type="submit" name="career_submit" value="Submit" class="btn btn-danger" />
            </form>
        </div>
    </div>
    <div class="agileits_copyright">
        <p>© Copyright 2018 Far East IT Solutions Limited- All Rights Reserved</p>
    </div>
</div>
<script src="js/filedrag.js"></script>
</body>
</html>