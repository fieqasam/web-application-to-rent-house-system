<?php 
session_start();
include('../db_connect.php');

//logout session
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

//update landlord section
if (isset($_POST['updateLandlord'])) {

    $landlordID = $_POST['landlordID'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $identityNo = $_POST['identityNo'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];

    $query = "UPDATE landlord SET name='$name', username='$username', email=' $email', contactNo='$contactNo', identityNo='$identityNo', address='$address' WHERE landlordID='$landlordID'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        echo "<script type='text/javascript'>alert('Landlord profile updated successful!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "landlordProfile.php";</script>';  
    }
    else{
        echo "<script type='text/javascript'>alert('Landlord profile failed to update!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "landlordProfile.php";</script>';
    }
}

//landlord insert rental house
if (isset($_POST['addHouse'])) 
{
    $userID = $_POST['userID'];
    $houseNo = $_POST['houseNo'];
    $location = $_POST['location'];
    $rentalPrice = $_POST['rentalPrice'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $house_image = $_FILES['house_image']['name'];
    $description = $_POST['description'];

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['house_image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    if (!in_array($file_extension, $allowed_extension))
    {
        $_SESSION = "You are allowed with only jpg, png, jpeg, and gif";
        header('Location: landlord_house.php');
    }
    else 
    {
        if (file_exists("../admin/uploads/house/".$_FILES['house_image']['name'])) 
        {
            $filename = $_FILES['house_image']['name'];
            $_SESSION['status'] = "Image already exist.".$filename;
            header('Location: landlord_house.php');
        }
        else 
        {
            $query = "INSERT INTO house(houseNo,location,rentalPrice,category,status,house_image,description,userID) VALUES ('$houseNo','$location','$rentalPrice','$category','$status','$house_image', '$description', '$userID')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) 
            {
                move_uploaded_file($_FILES["house_image"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image"]["name"]);
                $_SESSION['status'] = "You have success insert the rental house!";
                header("Location: landlord_house.php");
            }
            else{
                $_SESSION['status'] = "The rental house failed to insert.";
                header("Location: landlord_house.php");
            } 
        }
    }  
}

//landlord update house
if (isset($_POST['update_House']) && ! empty($_POST['houseID']))
{
    $houseID = $_POST['houseID'];
    $houseName = $_POST['houseName'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $monthlyPaid = $_POST['monthlyPaid'];
    $negotiable = $_POST['negotiable'];
    $deposit = $_POST['deposit'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $noRoom = $_POST['noRoom'];
    $noToilet=$_POST['noToilet'];
    $floorType = $_POST['floorType'];
    $airCond = $_POST['airCond'];
    $wifi = $_POST['wifi'];
    $furniture = $_POST['furniture'];
    $gate = $_POST['gate'];
    $cctv = $_POST['cctv'];
    $gateNguarded = $_POST['gateNguarded'];
    $kitchen = $_POST['kitchen'];
    $typeKitchen = $_POST['typeKitchen'];
    
        $query = " UPDATE houses SET houseName='$houseName', address1='$address1', address2='$address2', postcode='$postcode', district='$district', state='$state', monthlyPaid='$monthlyPaid', negotiable='$negotiable', category='$category', size='$size', noRoom='$noRoom', noToilet='$noToilet', floorType='$floorType', airCond='$airCond', kitchen='$kitchen', typeKitchen='$typeKitchen', wifi='$wifi', furniture='$furniture', gate='$gate', cctv='$cctv', gateNguarded='$gateNguarded', deposit='$deposit', description='$description' WHERE houseID='$houseID' ";
        $query_run = mysqli_query($con, $query);
       if ($query_run) 
       {
            echo "<script type='text/javascript'>alert('House updated successful!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = " landlord_house.php";</script>';
       }
       else
        {
            echo "<script type='text/javascript'>alert('House updated failed!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = " landlord_house.php";</script>';
       }
    
}

//delete house
if ( isset($_POST['delete_house_image']))
{
        $houseID = $_POST['delete_id'];
        $house_image1 = $_POST['delete_house_image'];
        $house_image2 = $_POST['delete_house_image'];
        $house_image3 = $_POST['delete_house_image'];
        $house_image4 = $_POST['delete_house_image'];

        $query = "DELETE FROM houses WHERE houseID='$houseID'";
        $query_run = mysqli_query($con, $query);
        
    
        if ($query_run)
        {
            unlink("../landlord/uploads/house/".$house_image1);
            unlink("../landlord/uploads/house/".$house_image2);
            unlink("../landlord/uploads/house/".$house_image3);
            unlink("../landlord/uploads/house/".$house_image4);

            echo "<script type='text/javascript'>alert('House deleted successful!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = " landlord_house.php";</script>';
        
        }
        else 
        {
            echo "<script type='text/javascript'>alert('House deleted failed!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = " landlord_house.php";</script>';
        }
}

//update password
if (isset($_POST['changePassBtn'])) 
{
   $userID = $_POST['userID'];
   $currentPass = $_POST['currentPass'];
   $newPass = $_POST['newPass']; 
   $confirmPass = $_POST['confirmPass'];
   
   if ($newPass == $confirmPass) {
      $newPass = md5($newPass);
      $query = "UPDATE users SET password='$newPass' WHERE userID='$userID'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) 
     {
        echo "<script type='text/javascript'>alert('Password updated successfully!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "updateProfile.php";</script>';
    }
   else 
   {
        echo "<script type='text/javascript'>alert('Password failed to updated!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "updateProfile.php";</script>';
   }

   }
   else 
   {
    echo "<script type='text/javascript'>alert('Your Password enter doesn't match with confirm password!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "updateProfile.php";</script>';
   }
   
}

//update tenant contract
if (isset($_POST['update_term'])) 
{
    $termID = $_POST['termID'];
    $monthlyPaid = $_POST['monthlyPaid'];
    $duration = $_POST['duration'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $overallPayment= $monthlyPaid * $duration;
    $newFile = $_FILES['file']['name'];
    $oldFile = $_POST['file_old'];
    
    if ($newFile != '') 
    {
        $update_filename = $_FILES['file']['name'];
    }
    else
    {
        $update_filename =  $oldImage ;
    }

    if (file_exists("../admin/uploads/contract/".$_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $_SESSION['status'] = "FILE already exists".$filename;
        header('Location: renew_term.php');
    }
    else
    {
        $query = "UPDATE term SET monthlypaid='$monthlyPaid', duration='$duration', filename='$update_filename', overallPayment='$overallPayment', startDate='$startDate', endDate='$endDate' WHERE termID='$termID'";
        $query_run = mysqli_query($con, $query);

       if ($query_run) 
       {
           if ($_FILES['file']['name'] != '')
            {
               move_uploaded_file($_FILES["file"]["tmp_name"], "../admin/uploads/contract/".$_FILES['file']['name']);
               unlink("../admin/uploads/contract/".$oldFile);
           }
           $_SESSION['status'] = "Success contract had been update.";
           header("Location:  renew_term.php");
       }
       else
        {
           $_SESSION['status'] = "Failed contract not been update.";
           header("Location: renew_term.php");
       }
    }
}

//delete tenant contract
if (isset($_POST['DeleteTermbtn'])) 
{
     $termID = $_POST['delete_id']; 
    
       $query = "DELETE FROM term WHERE termID='$termID'";
       $query_run = mysqli_query($con, $query);
    
       if ($query_run) 
       {
           $_SESSION['status'] = "Contract delete successfully!";
           header("Location: term.php");
       }
       else{
           $_SESSION['status'] = "Contract failed to delete.";
           header("Location: term.php");
       }  
}

//tenant checkout form

if (isset($_POST['submitTenantCheckOut']))
{
    $tenantID = $_POST['tenantID'];
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

    $query = "INSERT INTO tenant_out_form(keyholder,remote,nbulb,bulb,paint,window,tsink,ksink,doorLock,tlock,units,msg,status,tenantID) VALUES ('$keyholder','$remote','$nbulb', '$bulb', '$paint','$window','$tsink','$ksink','$doorLock','$tlock','$units','$msg','$status','$tenantID')";
    $query_run = mysqli_query($con, $query);
    if ($query_run) 
    {
     $_SESSION['status'] = "Form submitted succesffully.";
     header("Location: tenantCheckOut.php");
    }
    else 
    {
     $_SESSION['status'] = "Form failed to submit.";
     header("Location: tenantCheckOut.php");
    } 
}

//vacant tenant 
if (isset($_POST['vacantTenantBtn'])) {
    $id  = $_POST['id'];
    $status = $_POST['status'];
    $checkIn_ID =  $_POST['update_id'];
    $tenantStatus = $_POST['tenantStatus'];

    $query = "UPDATE house SET status='$status' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    $query_checkIn = "DELETE FROM  tenantcheckin  WHERE checkIn_ID LIKE'$checkIn_ID'";
    $query_checkIn_run = mysqli_query($con, $query_checkIn);

    $query_term = "DELETE FROM term WHERE checkIn_ID = $checkIn_ID";
    $query_term_run = mysqli_query($con, $query_term);
    

    if ( $query_run  && $query_checkIn_run ) 
    {
            $_SESSION['status'] = "Success Vacant the tenant.";
            header("Location: listTenant.php");  
              
    }  
    else 
    {
        $_SESSION['status'] = "Fail Vacant the tenant.";
        header("Location: listTenant.php"); 
    } 

}

//saveHousesLatest
if (isset($_POST['saveHouse']))
{
   $houseName = $_POST['houseName'];
   $category = $_POST['category'];
   $address1 = $_POST['address1'];
   $address2 = $_POST['address2'];
   $postcode = $_POST['postcode'];
   $district = $_POST['district'];
   $state = $_POST['state'];
   $size = $_POST['size'];
   $noRoom = $_POST['noRoom'];
   $noToilet = $_POST['noToilet'];
   $floorType = $_POST['floorType'];
   $livingRoom = $_POST['livingRoom'];
   $airCond = $_POST['airCond'];
   $kitchen = $_POST['kitchen'];
   $typeKitchen = $_POST['typeKitchen'];
   $wifi = $_POST['wifi'];
   $furniture = $_POST['furniture'];
   $gate = $_POST['gate'];
   $cctv = $_POST['cctv'];
   $gateNguarded = $_POST['gateNguarded'];
   $house_image1 = $_FILES['house_image1']['name'];
   $house_image2 = $_FILES['house_image2']['name'];
   $house_image3 = $_FILES['house_image3']['name'];
   $house_image4 = $_FILES['house_image4']['name'];
   $monthlyPaid = $_POST['monthlyPaid'];
   $negotiable = $_POST['negotiable'];
   $deposit = $_POST['deposit'];
   $description = $_POST['description'];
   $changeSubject = $_POST['changeSubject'];
   $userID = $_POST['userID'];
   $houseStatus = $_POST['houseStatus'];
 

   $contract =  $_FILES['file']['name'];
   $fileTempName = $_FILES['file']['tmp_name'];
   $path = "../landlord/uploads/contract/".$contract;


   $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
   $allowed_extension_file = array('pdf');

    $filename = $_FILES['house_image1']['name'];
    $filename2 = $_FILES['house_image2']['name'];
    $filename3 = $_FILES['house_image3']['name'];
    $filename4 = $_FILES['house_image4']['name'];
  

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file_extension = pathinfo($filename2, PATHINFO_EXTENSION);
    $file_extension = pathinfo($filename3, PATHINFO_EXTENSION);
    $file_extension = pathinfo($filename4, PATHINFO_EXTENSION);

 if (!in_array($file_extension, $allowed_extension))
    {
        echo "<script type='text/javascript'>alert('You are allowed with only jpg, png, jpeg, and gif');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "registerNewHouse.php";</script>';
    }
    else
    {
        $sql = "INSERT INTO  houses(houseName,category,address1,address2,postcode,district,state,size,noRoom,noToilet,floorType,livingRoom,airCond,kitchen,typeKitchen,wifi,furniture,gate,cctv,gateNguarded,house_image1,house_image2,house_image3,house_image4,monthlyPaid,negotiable,deposit,description,contract,changeSubject,userID,houseStatus) 
        VALUES('$houseName','$category','$address1','$address2','$postcode','$district','$state','$size','$noRoom','$noToilet','$floorType','$livingRoom','$airCond','$kitchen','$typeKitchen','$wifi','$furniture','$gate','$cctv','$gateNguarded','$house_image1','$house_image2','$house_image3','$house_image4','$monthlyPaid','$negotiable','$deposit','$description','$contract','$changeSubject','$userID','$houseStatus')";
        $sql_run = mysqli_query($con, $sql);

        if ($sql_run)
        {
            move_uploaded_file($fileTempName, $path);
            move_uploaded_file($_FILES["house_image1"]["tmp_name"], "../landlord/uploads/house/".$_FILES["house_image1"]["name"]);
            move_uploaded_file($_FILES["house_image2"]["tmp_name"], "../landlord/uploads/house/".$_FILES["house_image2"]["name"]);
            move_uploaded_file($_FILES["house_image3"]["tmp_name"], "../landlord/uploads/house/".$_FILES["house_image3"]["name"]);
            move_uploaded_file($_FILES["house_image4"]["tmp_name"], "../landlord/uploads/house/".$_FILES["house_image4"]["name"]);
            echo "<script type='text/javascript'>alert('New house added successful');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "registerNewHouse.php";</script>';
        }
        else
        {
            echo "<script type='text/javascript'>alert('New house added failed');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "registerNewHouse.php";</script>';
        }
    
    }

}

//send email to tenant 
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';

if (isset($_POST['sendEmail'])) {
    
//Get the submitted form data
$notifyID  = $_POST['notifyID'];
$tenantName = $_POST['tenantName'];
$subject = $_POST['subject'];
$rentalPaid = $_POST['rentalPaid'];
$deposit  = $_POST['deposit'];
$tenantEmail = $_POST['tenantEmail'];
$message = $_POST['message'];
$landlordID = $_POST['landlordID'];
$landlordEmail = $_POST['landlordEmail'];
$houseID = $_POST['houseID'];
$contract =$_FILES['attachment']['name'];
$tenantID = $_POST['tenantID'];

if (!empty($tenantEmail) && !empty($subject) && !empty($rentalPaid) && !empty($deposit) && !empty($message) && !empty($landlordID) && !empty($houseID)) {
    if (filter_var($tenantEmail, FILTER_VALIDATE_EMAIL) === false) 
    {
        echo "<script>alert('Please enter your valid email.');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "wishlistdetail.php";</script>';
    }else {
        $uploadStatus = 1;

        //upload attachment file
        if (!empty($_FILES["attachment"]["name"])) {
            
            //File path config
            $targetDir = "../landlord/uploads/contract/";
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
                     echo "<script>alert('Sorry, there was en error uploading your file.');</script>";
                     echo '<style>body{display:none;}</style>';
                     echo '<script>window.location.href = "wishlistdetail.php";</script>';
                 }
             }else{
                 $uploadStatus = 0;
                 echo "<script type='text/javascript'>alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload!');</script>";
                 echo '<style>body{display:none;}</style>';
                 echo '<script>window.location.href = "wishlistdetail.php";</script>';
             }

        }
        if($uploadStatus == 1){
             // Recipient
             $toEmail = $tenantEmail;

             // Sender
             $from = 'houserentalsystem34@gmail.com';
             $fromName = 'Rent House System';
             
             // Subject
             $emailSubject = $subject;
             
             // Message 
             $htmlContent = '<h2>'.$subject.'</h2>
                 <p>'.$message.'</p>
                 <p>Monthly House Rental Payment: RM'.$rentalPaid.'</p>
                 <p>Deposit: RM '.$deposit.'</p>';
            
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
             $returnpath = "-f" . $recipient;
             
               
             // Send email
            $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);
                    
            // Delete attachment file from the server
            @unlink($uploadedFile);
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
            $query="UPDATE houses SET houseStatus='In-Agreement' WHERE houseID LIKE $houseID";
            $query_in ="INSERT INTO rental(tenantName, rentalPaid, deposit, tenantEmail, agreement, houseID, landlordID, landlordEmail, notifyID, tenantID) VALUES('$tenantName', '$rentalPaid', '$deposit', '$tenantEmail', '$contract', '$houseID', '$landlordID', '$landlordEmail', '$notifyID', '$tenantID')";
            $query_in_run= mysqli_query($con,$query_in);
            $query_run=mysqli_query($con, $query);

            if ($query_run && $query_in_run) {
                
                    $msgClass = 'succdiv';        
                    echo "<script type='text/javascript'>alert('Your house contract has been submitted successfully!');</script>";
                    echo '<style>body{display:none;}</style>';
                    echo '<script>window.location.href = "wishlistdetail.php";</script>';
            }
           
        }else{
            echo "<script type='text/javascript'>alert('Your house contract submission failed, please try again!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "wishlistdetail.php";</script>';
        }

    }
    
}else{
    echo "<script type='text/javascript'>alert('Please fill all the fields!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "wishlistdetail.php";</script>';
    }
}

if (isset($_POST['update_signed_contract'])) {

    $rentalID = $_POST['rentalID'];
    $tenantID = $_POST['tenantID'];
    $houseID = $_POST['houseID'];
    $startDate = date('Y-m-d',strtotime($_POST['startDate']));
    $endDate = date('Y-m-d',strtotime($_POST['endDate'])); 
    $oldFile = $_POST['file_old'];
    $uploadSignedContract = $_FILES['uploadSignedContract']['name'];
    if ($uploadSignedContract != '') 
    {
        $update_filename = $_FILES['uploadSignedContract']['name'];
    }
    else
    {
        $update_filename =  $oldFile;
    }
    if (file_exists("../landlord/uploads/contract/".$_FILES['uploadSignedContract']['name'])) {
        $filename = $_FILES['uploadSignedContract']['name'];
        echo "<script type='text/javascript'>alert('FILE already exists".$filename. !"');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "uploadContract.php";</script>';
    }
    else
    {
        $query = "UPDATE rental SET agreement='$update_filename', startDate='$startDate', endDate='$endDate' WHERE rentalID='$rentalID'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            if ($_FILES['uploadSignedContract']['name'] != '')
            {
               move_uploaded_file($_FILES["uploadSignedContract"]["tmp_name"], "../landlord/uploads/contract/".$_FILES['uploadSignedContract']['name']);
               unlink("../landlord/uploads/contract/".$oldFile);
           }

           $query_house = "UPDATE houses SET houseStatus='Unavailable' WHERE houseID LIKE '$houseID'";
           $query_house_run = mysqli_query($con,$query_house);

           if ($query_house_run) {

                $start = new DateTime($startDate);
                $end = new DateTime($endDate);
                $interval = new DateInterval('P1M');
                $period = new DatePeriod($start, $interval, $end);
                $tag = array();

                foreach ($period as $month) {

                    $tag[] = "('".$month->format('Y-m-d')."','".$tenantID."', '".$rentalID."')";
                }
                $values = implode(",", $tag);
                $query_rental= mysqli_query($con, "INSERT INTO payment (dueDate, tenantID, rentalID) VALUES".$values);

                if ($query_rental) {
                        echo "<script type='text/javascript'>alert('Your lease agreement had been upload successfully!');</script>";
                        echo '<style>body{display:none;}</style>';
                        echo '<script>window.location.href = "uploadContract.php";</script>';
                }
                else{
                        echo "<script type='text/javascript'>alert('Your lease agreement failed to upload!');</script>";
                        echo '<style>body{display:none;}</style>';
                        echo '<script>window.location.href = "uploadContract.php";</script>';
                }

           }
           else {
            echo "<script type='text/javascript'>alert('House status fail to update!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "uploadContract.php";</script>';
           }
           
        }
        else
        {
            echo "<script type='text/javascript'>alert('Your lease agreement failed to upload!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "uploadContract.php";</script>';
       }
       
    }

}

$recipient = "";
if (isset($_POST['rejectEmail'])) {
  
    $recipient = $_POST['tenantEmail'];
    $subject = $_POST['subject'];
    $tenantNumber = $_POST['tenantNumber'];
    $tenantName = $_POST['tenantName'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sender = "From: houserentalsystem34@gmail.com";
    $htmlContent = '<h2>'.$subject.'</h2>
                    <p>'.$message.'</p>';

    if (empty($recipient) || empty($subject) ||empty($message) || empty($tenantName) || empty($tenantNumber)) {

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
                ?>
                <!-- display a success message if once mail sent sucessfully -->
                <div class="alert alert-success text-center">
                <?php  echo "<script>alert('Your email successfully sent to $recipient');</script>"; ?>
                </div>
                    <?php
            }else {
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
// Section for delete tenant info in rental table
if (isset($_POST['DeleteTenantbtn'])) {
    
    $rentalID = $_POST['delete_rental_id'];
    $houseID = $_POST['houseID'];
    $contractFile = $_POST['contractFile'];
    $pof = $_POST['pof'];
   
    $query ="UPDATE houses SET houseStatus='available' WHERE houseID ='$houseID'";
    $query_del =  mysqli_query($con, "DELETE FROM rental WHERE rentalID='$rentalID'");
    $query_run = mysqli_query($con, $query);

    unlink("../landlord/uploads/contract/".$contractFile);
    unlink("../landlord/uploads/payment/".$pof);

    if ($query_del && $query_run){

        echo "<script type='text/javascript'>alert('Vacant the tenant successful!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "listingTenant.php";</script>';        
    }
    else {
        echo "<script type='text/javascript'>alert('Vacant the tenant failed!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "listingTenant.php";</script>';   
       
    }
}

//handle complaint response
if (isset($_POST['complaintResponses'])) {

    $name =$_POST['name'];
    $complaintID = $_POST['complaintID'];
    $statusComplaint = $_POST['statusComplaint'];
    $remarks = $_POST['remarks'];

    $query_update = mysqli_query($con, "UPDATE complaint SET statusComplaint='$statusComplaint',remarks='$remarks' WHERE complaintID='$complaintID'");

    if ($query_update) {
        echo "<script type='text/javascript'>alert('Your message had been submit to $name!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "complaintResponses.php";</script>';
    }else {
        echo "<script type='text/javascript'>alert('Your message failed to submit!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "complaintResponses.php";</script>';
    }
}

//rental detail of tenant

if (isset($_POST['addRentalDetails'])) {
    
    $rentalID = $_POST['rentalID'];
    $tenantID = $_POST['tenantID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = new DateInterval('P1M');
    $period = new DatePeriod($start, $interval, $end);
    $tag = array();

    foreach ($period as $month) {

        $tag[] = "('".$month->format('Y-m-d')."','".$tenantID."', '".$rentalID."')";
    }
    $values = implode(",", $tag);
    $query_rental= mysqli_query($con, "INSERT INTO payment (dueDate, tenantID, rentalID) VALUES".$values);

    if ($query_rental) {
            echo "<script type='text/javascript'>alert('Your data inserted successfully!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "rentalInfo.php";</script>';
    }
    else{
            echo "<script type='text/javascript'>alert('Your data inserted failed!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "rentalInfo.php";</script>';
    }
}

//delete invoices
if (isset($_POST['DeleteInvoicebtn'])) {

    $paymentID = $_POST['delete_id'];

    $query_invoice_del = mysqli_query($con, "DELETE FROM payment WHERE paymentID='$paymentID'");

    if ($query__invoice_del) {
        //query fail to delete
        echo "<script type='text/javascript'>alert('Your invoice failed to delete!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "paymentdetail.php";</script>';
    }else {
        //query success to delete
        echo "<script type='text/javascript'>alert('Your invoce had been deleted!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "paymentdetail.php";</script>';
    }

}
//checklistForm update section
if (isset($_POST['checklistFormBtn'])) {
    
    $respID = $_POST['respID'];
    $statusChecklist = $_POST['statusChecklist'];

    $query_form = mysqli_query($con, "UPDATE reponses SET status='$statusChecklist' WHERE respID='$respID'");

    if ($query_form) {
        echo "<script type='text/javascript'>alert('Your checklist form successful to update!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "tenantCheckOut.php";</script>';
    }else {
        echo "<script type='text/javascript'>alert('Your checklist form failed to update!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "tenantCheckOut.php";</script>';
    }
}
//delete checklist form

if (isset($_POST['DeleteFormbtn'])) {
    $respID =$_POST['delete_id'];
    $query_get = mysqli_query($con, "SELECT * FROM reponses WHERE respID='$respID'");
    //query get response file
    while ($row = mysqli_fetch_array($query_get)) 
      {
        $responseFile = $row['responseFile'];
      }
      $respFile = $responseFile;
      unlink("../landlord/uploads/responses/".$respFile);

    $query_form_del = "DELETE FROM reponses WHERE respID='$respID'";
    $query__form_del_run = mysqli_query($con, $query_form_del);

    if ($query_form_del_run) {
        //display when it failed
        echo "<script type='text/javascript'>alert('Your checklist form failed to delete!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "tenantCheckOut.php";</script>';
    }
    else {
       //display when it success
        echo "<script type='text/javascript'>alert('Your checklist form delete successful!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "tenantCheckOut.php";</script>';
        
    }

}

//update status payment information
if (isset($_POST['updatePaymentStatus'])) {
    
    $paymentID = $_POST['paymentID'];
    $statusPayment = $_POST['statusPayment'];

    $query_status = mysqli_query($con, "UPDATE payment SET statusPayment='$statusPayment' WHERE paymentID='$paymentID'");

    if ($query_status) 
    {
        echo "<script type='text/javascript'>alert('Your status payment updated successful!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "rentalList.php";</script>';
    }
    else {
        echo "<script type='text/javascript'>alert('Your status payment updated failed!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "rentalEdit.php";</script>';
    }
}
?>


