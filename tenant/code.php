<?php
session_start();
include('../db_connect.php');
require('../fpdf184/fpdf.php');

if (isset($_POST['logoutBtn'])) 
{
   //session_destroy();
   unset($_SESSION['auth']);
   unset($_SESSION['auth_user']);
   echo "<script type='text/javascript'>alert('Logged out successfully!');</script>";
   echo '<style>body{display:none;}</style>';
   echo '<script>window.location.href = "../signIn.php";</script>';
   exit(0);
}
//update tenant profile
if (isset($_POST['updateTenant'])) {

    $tenantID = $_POST['tenantID'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $identificationNo = $_POST['identificationNo'];
    $occupation = $_POST['occupation'];
    $phoneNo = $_POST['phoneNo'];
    $address = $_POST['address'];

    $query = "UPDATE tenant SET fullName='$fullName', email=' $email', identificationNo='$identificationNo',  occupation='$occupation', phoneNo='$phoneNo',  address='$address' WHERE tenantID='$tenantID'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        echo "<script type='text/javascript'>alert('Your profile updated successfully!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = " tenantInfo.php";</script>';
    }
    else{
        echo "<script type='text/javascript'>alert('Your profile failed to update!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = " tenantInfo.php";</script>';
    }
}

//change password
if (isset($_POST['changePassBtn'])) 
{
   $userID = $_POST['userID'];
   $currentPass = $_POST['currentPass'];
   $newPass = $_POST['newPass']; 
   $confirmPass = $_POST['confirmPass'];
   
   if ($newPass == $confirmPass) 
   {
      $newPass = md5($newPass);
      $query = "UPDATE users SET password='$newPass' WHERE userID='$userID'";
      $query_run = mysqli_query($con, $query);
    if ($query_run) 
    {
        echo "<script type='text/javascript'>alert('Password updated successfully!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "changePass.php";</script>';
    }
   else 
   {
        echo "<script type='text/javascript'>alert('Password failed to updated!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "changePass.php";</script>';
   }

   }
   else 
   {
    echo "<script type='text/javascript'>alert('Your Password enter doesn't match with confirm password!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "changePass.php";</script>';
   }
   
}

//Add Contact Information

if (isset($_POST['addContact'])) 
{
   $tenantID = $_POST['tenantID'];
   $contactName= $_POST['contactName'];
   $email =$_POST['email'];
   $contactNo = $_POST['contactNo'];
   $address = $_POST['address'];
   $occupation = $_POST['occupation'];
   $relationContact = $_POST['relationContact'];

   $query = "INSERT INTO contactinformation(contactName,email,contactNo,address,occupation,relationContact,tenantID) VALUES ('$contactName','$email','$contactNo', '$address', '$occupation','$relationContact','$tenantID')";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
    echo "<script type='text/javascript'>alert('Your contact information was added successfully!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "contactInfo.php";</script>';
   }
   else 
   {
    echo "<script type='text/javascript'>alert('Contact information failed to add. Please try again!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "contactInfo.php";</script>';
   }  
}

if (isset($_POST['submitForm'])) 
{
    $checkIn_ID=$_POST['checkIn_ID'];
    $tenantName=$_POST['tenantName'];
    $keyholder=$_POST['keyholder'];
    $remote=$_POST['remote'];
    $nbulb=$_POST['nbulb'];
    $bulb=$_POST['bulb'];
    $paint=$_POST['paint'];
    $window=$_POST['window'];
    $tsink=$_POST['tsink'];
    $ksink=$_POST['ksink'];
    $doorLock=$_POST['doorLock'];
    $tlock=$_POST['tlock'];
    $units=$_POST['units'];
    $msg=$_POST['msg'];
    $status=$_POST['status'];

    $query = "INSERT INTO tenant_in_form(keyholder,remote,nbulb,bulb,paint,window,tsink,ksink,doorLock,tlock,units,msg,status,checkIn_ID,tenantName) VALUES ('$keyholder','$remote','$nbulb', '$bulb', '$paint','$window','$tsink','$ksink','$doorLock','$tlock','$units','$msg','$status','$checkIn_ID','$tenantName')";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) 
    {
     $_SESSION['status'] = "Form submitted succesffully.";
     header("Location: tenant_checkIn.php");
    }
    else 
    {
     $_SESSION['status'] = "Form failed to submit.";
     header("Location: tenant_checkIn.php");
    } 
}

//submit signed contract
if (isset($_POST['submitFile'])) {

   $recipient=$_POST['emailLandlord'];
   $emailTenant = $_POST['emailTenant'];
   $houseID = $_POST['houseID'];
   $tenantName = $_POST['tenantName'];
   $message = $tenantName." have uploaded the files in the system.";
   $subject = "Contract Upload";
   $sender =  "From: houserentalsystem34@gmail.com";
   $tenantID = $_POST['tenantID'];
   $newFile = $_FILES['fileContract']['name'];
   $newFile2 = $_FILES['filePayment']['name'];
  
    $query = "UPDATE rental SET agreement='$newFile', filePayment='$newFile2', tenantName='$tenantName' WHERE tenantID='$tenantID' AND houseID='$houseID'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
          if ($_FILES['fileContract']['name'] != '')
           {
              move_uploaded_file($_FILES["fileContract"]["tmp_name"], "../landlord/uploads/contract/".$_FILES['fileContract']['name']);
              move_uploaded_file($_FILES["filePayment"]["tmp_name"], "../landlord/uploads/payment/".$_FILES['filePayment']['name']);
          }
          //send notification to lanlord
          // PHP function to send mail
        if(mail($recipient, $subject, $message, $sender)){
           
         echo "<script type='text/javascript'>alert('Your mail successfully sent to $recipient');</script>";
         echo '<style>body{display:none;}</style>';
         echo '<script>window.location.href = "tenant_contract.php";</script>';
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Your mail failed to be sent to the $recipient');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "tenant_contract.php";</script>';
    }
   
}

//submit completed checklist form to landlord
if (isset($_POST['submitResponse'])) {
    
    $rentalID = $_POST['rentalID'];
    $landlordEmail = $_POST['landlordEmail'];
    $landlordID=$_POST['landlordID'];
    $tenantName = $_POST['tenantName'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $attachment = $_FILES['attachment']['name'];
    $date =  date('y-m-d h:i:s');

    if (!empty($tenantName) && !empty($subject) && !empty($message) && !empty($attachment) && !empty($rentalID) && !empty($landlordID) && !empty($landlordEmail)) {
        if (filter_var($landlordEmail, FILTER_VALIDATE_EMAIL) === false) 
        {
            echo "<script type='text/javascript'>alert('Please enter your valid email.');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "uploadChecklist.php";</script>';
           
        }else {
            $uploadStatus = 1;
    
            //upload attachment file
            if (!empty($_FILES["attachment"]["name"])) {
                
                //File path config
                $targetDir = "../landlord/uploads/responses/";
                $fileName = basename($_FILES["attachment"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
                 // Allow certain file formats
                 $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
                 if(in_array($fileType, $allowTypes)){
                     // Upload file to the server
                     if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){
                         $uploadedFile = $targetFilePath;
                     }else{
                        $uploadStatus = 0;
                        echo "<script type='text/javascript'>alert('Sorry, there was en error uploading your file.');</script>";
                        echo '<style>body{display:none;}</style>';
                        echo '<script>window.location.href = "uploadChecklist.php";</script>';
                        
                     }
                 }else{
                     $uploadStatus = 0;
                     echo "<script type='text/javascript'>alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');</script>";
                     echo '<style>body{display:none;}</style>';
                     echo '<script>window.location.href = "uploadChecklist.php";</script>';
                 }
    
            }
            if($uploadStatus == 1){
                 // Recipient
                 $toEmail = $landlordEmail;
    
                 // Sender
                 $from = 'houserentalsystem34@gmail.com';
                 $fromName = 'Rent House System';
                 
                 // Subject
                 $emailSubject = $subject." $tenantName";
                 
                 // Message 
                 $htmlContent = $message;
                // Header for sender info
                 $headers = "From: $fromName"." <".$from.">";
    
                 if (!empty($uploadedFile) && file_exists($uploadedFile)) {
                     
                     // Boundary 
                     $semi_rand = md5(time()); 
                     $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                     
                     // Headers for attachment 
                     $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                     
                     // Multipart boundary 
                     $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                     "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
                      // Preparing attachment
                      if(is_file($uploadedFile)){
                        $message .= "--{$mime_boundary}\n";
                        $fp =    @fopen($uploadedFile,"rb");
                        $data =  @fread($fp,filesize($uploadedFile));
                        @fclose($fp);
                        $data = chunk_split(base64_encode($data));
                        $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" . 
                        "Content-Description: ".basename($uploadedFile)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    }
                 }
    
                 $message .= "--{$mime_boundary}--";
                 $returnpath = "-f" . $landlordEmail;
                 
                   
                 // Send email
                $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);
                        
        
            }else {
                  // Set content-type header for sending HTML email
                  $headers .= "\r\n". "MIME-Version: 1.0";
                  $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
                  
                  // Send email
                  $mail = mail($toEmail, $emailSubject, $htmlContent, $headers); 
            }
             
            // If mail sent
            if($mail){     
                $postData = '';
                $query_submit = "INSERT INTO reponses(tenantName,responseFile,message,rentalID,landlordID,dateSent) VALUES('$tenantName','$attachment','$htmlContent','$rentalID','$landlordID','$date')";
                $query_submit_run = mysqli_query($con, $query_submit);

                if ($query_submit_run) {
                        echo "<script type='text/javascript'>alert('Your checklist form submitted successfully');</script>";
                        echo '<style>body{display:none;}</style>';
                        echo '<script>window.location.href = "uploadChecklist.php";</script>';
                        $msgClass = 'succdiv';       
                      
                }
               
            }else{
                echo "<script type='text/javascript'>alert('Your checklist form failed to submit!');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = "uploadChecklist.php";</script>';
               
            }
    
        }
        
    }else{
        echo "<script type='text/javascript'>alert('Please fill all the fields.');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "uploadChecklist.php";</script>';
    }

}

if (isset($_POST['submitComplaint'])) {

    $name = $_POST['name'];
    $complaintMessage = $_POST['complaintMessage'];
    $houseID = $_POST['houseID'];
    $tenantID = $_POST['tenantID'];
    $date = date('y-m-d h:i:s');

    $query_send = "INSERT INTO complaint(name,complaintMessage,tenantID,houseID,complaintDate) VALUES('$name','$complaintMessage','$tenantID','$houseID','$date')";
    $query_send_run = mysqli_query($con, $query_send);

    if ($query_send_run) {
        echo "<script type='text/javascript'>alert('Complaint submitted successfully!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "complaint.php";</script>';
    }
    else {
        echo "<script type='text/javascript'>alert('Complaint submitted failed!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "complaint.php";</script>';
    }

    
}
//section for process payment
if (isset($_POST['submitPayment'])) {

    $amountPay = $_POST['amountPay'];
    $datePayment = date('y-m-d h:i:s');
    $recipient = $_POST['recipient'];
    $paymentID = $_POST['paymentID'];
    $tenantName = $_POST['tenantName'];
    $subject = "HRAS Rental Payment Confirmation";
    $message = "
                 <html>
                <head>
                    <title>Rental Payment Confirmation</title>
                </head>
                <body>
                <p>Dear $tenantName,</p> <br />
                 
                <p>Your rental payment no #$paymentID has been received by our system.</p>
                <p>The total amount of your payment no #$paymentID is RM$amountPay</p>
                <p>Please allow 2-3 working days for us to process your payment.</p>
                <br />
                <p>Kindly contact us if there's a mistake.</p>
                </body>
             </html> ";
    $sender = "From: houserentalsystem34@gmail.com";
    $htmlContent = '<h2>'.$subject.'</h2>
                    <p>'.$message.'</p>';
         
    //auto generate invoice no
    $sql1 = "SELECT refNo FROM payment WHERE paymentID = '$paymentID'";
    $res = mysqli_query($con, $sql1);
    $refNo=0;
      while ($row = mysqli_fetch_array($res)) 
      {
          $refNo = $row['refNo'];
      }
      $next_id = (int)$refNo +1;
      $prefix = "1009-4520";
      $billnumber = $prefix."-".sprintf('%06d',$next_id);
      $query_payment = "UPDATE payment SET refNo='$billnumber', amountPay='$amountPay', datePay='$datePayment' WHERE paymentID LIKE $paymentID";
      $query_payment_run = mysqli_query($con, $query_payment);
      $query="UPDATE payment SET statusPayment='Paid' WHERE paymentID LIKE $paymentID";
      $query_run=mysqli_query($con, $query);

      if ($query_payment_run && $query_run) {
        if (empty($recipient) || empty($subject) ||empty($message) || empty($tenantName)) {

            ?>
            <div class="alert alert-danger text-center">
            <?php  echo "<script>alert('Fill all the inputs!');</script>"; ?>
            </div>
            <?php
        }else {
            if (filter_var($recipient, FILTER_VALIDATE_EMAIL) === false) 
            {
                echo "<script>alert('Please enter your valid email.');</script>";
            }else {
                $uploadStatus = 1;
    
                if ($uploadStatus = 1) {
                      // Recipient
                 $toEmail = $recipient;
    
                 // Sender
                 $from = 'houserentalsystem34@gmail.com';
                 $fromName = 'Rent House System';
                 
                 // Subject
                 $emailSubject = $subject;
                 
                 // Message 
                
                 $htmlContent = '<h2>'.$subject.'</h2>
                 <p>'.$message.'</p>';
    
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

                if ($mail) {
                    $_SESSION['status'] = "We've send an email.Please check your email!";
                    header("Location: tenantPay.php");
                    
                }else {
                    $_SESSION['status'] = "We've failed to send the email.Please try again.";
                    header("Location: tenantPay.php");
                }
            }
        }
    
      }
      else {
        $_SESSION['status'] = "We've failed to process your payment!";
        header("Location: tenantPay.php");
      }
    
}

//Delete Message Button
if (isset($_POST['DeleteMessagebtn'])) {
    
    $complaintID = $_POST['delete_id'];

    $query_del = mysqli_query($con, "DELETE FROM complaint WHERE complaintID='$complaintID'");

    if ($query_del) {
        echo "<script type='text/javascript'>alert('Your message had been delete!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "send_msg.php";</script>';
    }
    else {
        echo "<script type='text/javascript'>alert('Your message failed to delete!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "send_msg.php";</script>';
    }
}

?>