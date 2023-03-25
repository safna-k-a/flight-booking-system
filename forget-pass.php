<?php
    require "connection.php";  
    require "header.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    $token = bin2hex(random_bytes(32));
    if(isset($_POST['submit']) && $_POST['email']){
        $email_address = $_POST['email'];
        $query = $connection->prepare("UPDATE register   SET token=:token WHERE email=:email");
        $query->execute(array(':token' => $token, ':email' => $email_address));
        $reset_url = "https://std005.orisysacademy.com/reset-pass.php?token=" . $token;

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'arjunmail716007@gmail.com';                     //SMTP username
            $mail->Password   = 'bnfavztcyrpxojty';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('arjunmail716007@gmail.com', 'FlyHigh.com');
            $mail->addAddress($email_address);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
    
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password reset';
            $mail->Body    = 'To reset your password, please click the following link:'.$reset_url;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo "<script>Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Mail Sent',
                showConfirmButton: false,
                timer: 1500
              }).then(function(){
                    window.location='index.php';
              });
              </script>";
        } catch (Exception $e) {
            echo '<script>alert("Message not sent");</script>';
        }

    }
?>
<div class="">
                <form
                    action=""
                    method="POST"
                    class="form-control rounded-3 p-5 width mx-auto my-5"
                >
                    <div class="form-floating mb-1">
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Enter Email"
                            id="email"
                            name="email"
                            required
                        />
                        <label for="email" class="form-label">Enter Email</label>
                    </div>
                    
                    <div class="text-center mt-2">
                        <input
                            type="submit"
                            value="submit"
                            class="bg-primary px-4 py-2 rounded-2 text-light border-0"
                            name="submit"
                        />
                    </div>
                </form>
</div>
<?php
    require "footer.php";
?>