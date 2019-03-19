<?php
//index.php

$error = '';
$name = '';
$email = '';
$phone = '';
$company = '';
$category = '';
$address = '';
$message = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit"]))
{
    if(empty($_POST["name"]))
    {
        $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
    }
    else
    {
        $name = clean_text($_POST["name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST["email"]))
    {
        $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
    }
    else
    {
        $email = clean_text($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error .= '<p><label class="text-danger">Invalid email format</label></p>';
        }
    }
    if(empty($_POST["phone"]))
    {
        $error .= '<p><label class="text-danger">Phone is required</label></p>';
    }
    else
    {
        $subject = clean_text($_POST["phone"]);
    }
    if(empty($_POST["company"]))
    {
        $error .= '<p><label class="text-danger">Company is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["company"]);
    }
    if(empty($_POST["category"]))
    {
        $error .= '<p><label class="text-danger">Category is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["category"]);
    }
    if(empty($_POST["address"]))
    {
        $error .= '<p><label class="text-danger">Address is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["address"]);
    }
    if($error == '')
    {
        require 'class/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.feits.co';  //Sets the SMTP hosts
        $mail->Port = '465';        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'web@feits.co';     //Sets SMTP username/gmail
        $mail->Password = 'web@feits';     //Sets SMTP password
        $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = $_POST["email"];     //Sets the From email address for the message
        $mail->FromName = $_POST["name"];    //Sets the From name of the message
        $mail->AddAddress('web@feits.co', 'web@feits.co');//Adds a "To" address
        $mail->AddCC($_POST["email"], $_POST["name"]); //Adds a "Cc" address
        $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);       //Sets message type to HTML
        $mail->Subject = $_POST["category"];    //Sets the Subject of the message
        $mail->Body ='<h4>User Request from feits.co website</h4>'.'<br>'.'Name:'.$_POST["name"].'<br>'.$_POST["email"].'<br>'.'Mobile:'.$_POST["phone"].'<br>'.'Company:'.$_POST["company"].'<br>'.'Required Software:'.$_POST["category"].'<br>'.'Address:'.$_POST["address"];    //An HTML or plain text message body
        if($mail->Send())        //Send an Email. Return true on success or false on error
        {
            $error = '<label class="text-success">Thank you for contacting us</label>';
        }
        else
        {
            $error = '<label class="text-danger">There is an Error</label>';
        }
        $error = '';
        $name = '';
        $email = '';
        $phone = '';
        $company = '';
        $category = '';
        $address = '';
        $message = '';
    }
}

?>
<?php include 'header_1.php';?>

<title>Far East IT Solutions Limited</title>

<?php include 'header_2.php';?>


<section id="home" class="mainbg from-login">
    <div class="home-overlay"></div>
    <div class="home-content form-content">
        <div class="container">
            <div class="row">
                <div class="home-content-inner from-part-inner">
                    <div class="col-md-10 col-lg-9 m-auto col-sm-12 col-12">
                        <h3 class="text-center">Demo Request</h3>
                        <span class="demo-span"></span>
                        <?php echo $error; ?>
                        <form  method="post">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name"> Name *</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" id="uname" value="<?php echo $name; ?>">
                                        <span id="unames" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Email *</label>
                                        <input type="text" class="form-control" placeholder="Email" name="email" id="uemail" value="<?php echo $email; ?>">
                                        <span id="uemails" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Phone Number * </label>
                                        <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="mobilenum">
                                        <span id="mobilenums" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Company Name" name="company" id="companyname" >
                                        <span id="companynames" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FormControlSelect" class="demo-label-name"> Choose Your Software * </label>
                                        <select name="category" class="form-control">
                                            <option value="">Choose Your Software.....</option>
                                            <option value="Human Rresource Management System">Human Rresource Management System</option>
                                            <option value="Diagonistic Management System">Diagonistic Management System</option>
                                            <option value="Restaurant Management System">Restaurant Management System</option>
                                            <option value="Pharmacy Management System">Pharmacy Management System</option>
                                            <option value="Pharmacy Management System">FEITS Healthcare</option>
                                            <option value="shop inventory management system">Shop Inventory Management System</option>

                                        </select>
                                        <span id="software" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name"> Address *</label>
                                        <textarea placeholder="Address" class="form-control" column="3" name="address" id="address"></textarea>
                                        <span id="addresss" class="text-danger"></span>
                                    </div>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>