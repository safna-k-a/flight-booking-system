<?php
    session_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // $db = new PDO("mysql:host=localhost;dbname=afrs", "root", "");
    require "config.php";
    echo "hello";
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    $u_id=$_SESSION['u_id'];
    $amt=$_SESSION['amt'];
    $tot=$_SESSION['tot'];
    $seat_no=$_SESSION['seat_no'];
    $name=$_SESSION['name'];
    $b_id=$_SESSION['b_id'];
    $s=$_SESSION['status'];
    $n=count($name);
    $billname="b"."$u_id"."$b_id";
    $ticketname="t"."$u_id"."$b_id";
    echo $billname;
     if($s==1){
        echo "<h1>Success</h1>";
        require('fpdf/fpdf.php');
        require('fpdi/src/autoload.php');

        //fetch name from register
        $sql="SELECT * FROM register WHERE id=:id";
        $stmt=$db->prepare($sql);
        $stmt->execute([':id'=>$u_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $u_name=$user->name;
        // $email_address=$user->email;
        $email_address="arjunmnair716@gmail.com";

        // Create a new FPDI object
        $pdf = new \setasign\Fpdi\Fpdi();
        $pdf1 = new \setasign\Fpdi\Fpdi();

        //for ticket
        // Add a page from an existing PDF file
        $pdf->setSourceFile('ticket.pdf');
        $tplIdx = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($tplIdx);

        // Write content to the PDF
        $pdf->SetFont('Arial','B',20);
        $pdf->SetTextColor(0,0,0);
        $in=80;
        for($i=0;$i<$n;$i++){
            $pdf->SetXY(80, $in);
            $pdf->Write(0, 'Name    :'.$name[$i]);
            $in=$in+30;
            $pdf->SetXY(80, $in);
            $pdf->Write(0, 'Seat No :'.$seat_no[$i]);
            $in=$in+30;
        }
       // Output the modified PDF
       $tname = 'tickets/' . $ticketname . '.pdf';
       $pdf->Output($tname, 'F');

        //for bill
        // Add a page from an existing PDF file
        $pdf1->setSourceFile('bill.pdf');
        $tplIdx = $pdf1->importPage(1);
        $pdf1->AddPage();
        $pdf1->useTemplate($tplIdx);

        // Write content to the PDF
        $pdf1->SetFont('Arial','B',20);
        $pdf1->SetTextColor(0,0,0);
        $pdf1->SetXY(45,62);
        $pdf1->Write(0, $u_name);
        $pdf1->SetFont('Arial','B',16);
        $pdf1->SetTextColor(0,0,0);
        $pdf1->SetXY(20,80);
        $pdf1->Write(0, 'Number');
        $pdf1->SetXY(60,80);
        $pdf1->Write(0, 'Name');
        $pdf1->SetXY(100,80);
        $pdf1->Write(0, 'Seat No');
        $pdf1->SetXY(140,80);
        $pdf1->Write(0, 'Amount');
        $x=20;
        $y=100;
        for($i=0;$i<$n;$i++){
            $pdf1->SetXY($x,$y);
            $pdf1->Write(0,$i+1);
            $pdf1->SetXY($x+40,$y);
            $pdf1->Write(0, $name[$i]);
            $pdf1->SetXY($x+80,$y);
            $pdf1->Write(0, $seat_no[$i]);
            $pdf1->SetXY($x+120,$y);
            $pdf1->Write(0, $amt[$i]);
            $y=$y+20;
        }
        $pdf1->SetFont('Arial','B',20);
        $pdf1->SetXY(40,$y);
        $pdf1->Write(0, 'TOTAL');
        $pdf1->SetXY($x+120,$y);
        $pdf1->Write(0, $tot);
       // Output the modified PDF
       $bname = 'bills/' . $billname . '.pdf';
        $pdf1->Output($bname, 'F');
        




        //Send mail to user.
       


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
            $mail->setFrom('arjunmail716007@gmail.com', 'FlyHigh.COM');
            $mail->addAddress($email_address);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
    
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment($tname, 'Ticket');    //Optional name
            $mail->addAttachment($bname, 'Bill');    //Optional name

    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Booking Confirmed';
            $mail->Body    = 'User Ticket is Confirmed..... Happy Journey.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo '<script>alert("Message sent");</script>';
        } catch (Exception $e) {
            echo '<script>alert("Message not sent");</script>';
        }
    }
    
    else{
        echo "Failed";
    }
?>

<h1>Success</h1>
