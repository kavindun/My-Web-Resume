<?php
  $nameErr = $emailErr = "";
  $name = $email = $message = $subject = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed"; 
      }
    }
  
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format"; 
      }
    }
  
    if (empty($_POST["subject"])) {
      $subject = "";
    } else {
      $subject = test_input($_POST["subject"]);
    }
  
    if (empty($_POST["message"])) {
      $message = "";
    } else {
      $message = test_input($_POST["message"]);
    }
  
    
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  if(($emailErr=="")and($nameErr=="")){
    //$msg = "<h3>$name</h3><br><h3>Email : $email</h3><br><h3>$subject<h3><br><p>$message</p>";
   // echo $msg;
  
    // use wordwrap() if lines are longer than 70 characters
    //$msg = wordwrap($msg,70);
    
    // send email
    //mail("kavindujd1995@gmail.com","My subject",$msg);
    //echo "<h3>Sent</h3>"
    require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();

    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='cvmessage0@gmail.com';
    $mail->Password='kn//pcpass283';

    $mail->setFrom($email);
    $mail->addAddress('kavindujd1995@gmail.com');

    $mail->isHTML(true);
    $mail->isSMTP();
    $mail->Subject='From Submission : '.$subject;
    $mail->Body='<h1>Name : '.$name.'<br>Email : '.$email.'<br>Subject : '.$subject.'<br>Message : '.$message.'</h1>';
    if(!$mail->send()){
      echo "Something went wrong.Please try again.";
    }
    else{
      echo "Thanks ".$name."for contacting me. I will get back to you soon!";
    }
  }
  else{
    echo "Invalid inputs.Please try again.";
  }
?>
