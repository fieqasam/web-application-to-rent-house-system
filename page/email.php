<?php 
include('../db_connect.php');

//leave the input field blank, referring to landlord email
$recipient ="";
//input fields in the form once user clicked button
if (isset($_POST['submit'])) {
    //list of variables
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $senderName = $_POST['senderName'];
    $senderEmail = $_POST['senderEmail'];
    $senderNumber = $_POST['senderNumber'];
    $message = $_POST['message'];
    $landlordID = $_POST['landlordID'];
    $houseID = $_POST['houseID'];
    $tenantID = $_POST['tenantID'];
    $date = date('y-m-d h:i:s');
    $sender = "From: houserentalsystem34@gmail.com";
    $htmlContent = '<h2>'.$subject.'</h2>
                    <p><b>Name:'.$message.'</p>
                    <p><b>Email:'.$senderEmail.'</p>
                    <p><b>Contact Number:</b>'.$senderNumber.'</p>
                    <p><b>Message:</b> RM '.$message.'</p>';


    if (empty($recipient) || empty($subject) || empty($senderEmail) || empty($senderNumber) || empty($senderName) || empty($recipient) || empty($message)) {
        
        ?>
        <div class="alert alert-danger text-center">
        <?php  echo "<script>alert('Fill all the inputs!');</script>"; ?>
        </div>
        <?php
    }else {
        if (filter_var($senderEmail, FILTER_VALIDATE_EMAIL) === false) 
    {
        echo "<script>alert('Please enter your valid email.');</script>";
    }else {
        $uploadStatus = 1;
     
        if($uploadStatus == 1){
             // Recipient
             $toEmail = $recipient;

             // Sender
             $from = 'houserentalsystem34@gmail.com';
             $fromName = 'Rent House System';
             
             // Subject
             $emailSubject = $subject;
             
             // Message 
            
             $htmlContent = '<h2>Rental House Inquiry</h2>
             <p>Name: '.$senderName.'</p>
             <p>Email: '.$senderEmail.'</p>
             <p>Contact number: '.$senderNumber.'</p>
             <p>Message: '.$message.'</p>';

            // Header for sender info
             $headers = "From: $fromName"." <".$from.">";

                 // Boundary 
                 $semi_rand = md5(time()); 
                 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                 
                 // Headers for attachment 
                 $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                 
                 // Multipart boundary 
                 $messages = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                 "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 


             $messages .= "--{$mime_boundary}--";
             $returnpath = "-f" . $recipient;
             
               
             // Send email
            $mail = mail($toEmail, $emailSubject, $messages, $headers, $returnpath);
                    
        
        }else {
              // Set content-type header for sending HTML email
              $headers .= "\r\n". "MIME-Version: 1.0";
              $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
              
              // Send email
              $mail = mail($toEmail, $emailSubject, $htmlContent, $headers); 
        }
         
        // If mail sent
        if($mail){     
            ?>
            <!-- display a success message if once mail sent sucessfully -->
            <div class="alert alert-success text-center">
            <?php  echo "<script>alert('Your email successfully sent to $recipient');</script>"; ?>
            </div>
            <?php
              $query = "INSERT INTO notifications(senderName, senderEmail, senderNumber, message, landlordID, houseID, tenantID, date) VALUES('$senderName','$senderEmail','$senderNumber','$message','$landlordID','$houseID','$tenantID','$date')";
              $query_run = mysqli_query($con, $query);
              if ($query_run) {
                ?>
                <div class="alert alert-danger text-center">
                <?php  echo "<script>alert('Success! your message have been record in database.');</script>"; 
                header("Location: rent.php");
                ?>
                </div>
                <?php
              }
              else {
                ?>
                <div class="alert alert-danger text-center">
                <?php echo "<script>alert('Failed to record in database.');</script>"; 
                    header("Location: rent.php");
                ?>
                </div>
                <?php 
                }
    }
    else {
        ?>
        <!-- display an alert message if somehow mail can't be sent -->
        <div class="alert alert-danger text-center">
        <?php  echo "<script>alert('Failed while sending your mail!');</script>"; ?>
        </div>
        <?php
        }
    }

    }
}
?>
