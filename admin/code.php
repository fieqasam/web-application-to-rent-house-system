<?php
session_start();
include('../db_connect.php');

if (isset($_POST['logoutBtn'])) 
{
   //session_destroy();
   unset($_SESSION['auth']);
   unset($_SESSION['auth_user']);
   
   $_SESSION['status'] = "Logged out successfully";
   header("Location: ../signIn.php");
   exit(0);
}

if (isset($_POST['check_Emailbtn'])) 
{
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email' ";
    $checkemail_run = mysqli_query($con, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0)
    {
       echo "Email is already taken."; 
    }
    else
    {
        echo "It's available";
    }
}

#query for insert data 
if (isset($_POST['addUser'])) 
{
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role'];

    if ($password == $confirmPassword) 
    {
        $password = md5($password);

        $user_query = "INSERT INTO users (fullName,username,email,phoneNo,password,role) VALUES ('$fullName','$username','$email','$phoneNo','$password','$role')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) 
        {
            $_SESSION['status'] = "User added successfully";
            header("Location: registered.php");
        }
        else{
            $_SESSION['status'] = "User failed to add";
            header("Location: registered.php");
        }
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match";
            header("Location: registered.php");
    }
    
}

//query for update
if (isset($_POST['updateUser']))
{
    $userID = $_POST['userID'];
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "UPDATE users SET fullname='$fullName', username='$username', email='$email', phoneNo='$phoneNo', password='$password', role='$role' WHERE userID='$userID' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        $_SESSION['status'] = "User updated successfully!";
        header("Location: registered.php");
    }
    else{
        $_SESSION['status'] = "User failed to update.";
        header("Location: registered.php");
    }
}

//query for delete user
if (isset($_POST['DeleteUserbtn'])) 
{
   $userID = $_POST['delete_id']; 

   $query = "DELETE FROM users WHERE userID='$userID'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
       $_SESSION['status'] = "User delete successfully!";
       header("Location: registered.php");
   }
   else{
       $_SESSION['status'] = "User failed to delete.";
       header("Location: registered.php");
   }
}

//update for profile image
if (isset($_POST['saveProfile']))
{
    $userID = $_SESSION['auth_user']['userID'];
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $files = $_FILES['profileUpload'];
    $profileImage = upload_profile('../assets/profile/', $files);

    $query = "UPDATE users SET profileImage='$profileImage' WHERE userID='$userID' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        $_SESSION['status'] = "User updated successfully!";
        header("Location: adminProfile.php");
    }
    else{
        $_SESSION['status'] = "User failed to update.";
        header("Location: adminProfile.php");
    }
}

// ADD HOUSE SECTION
if (isset($_POST['addHouse']))
{
    $id = $_GET['id'];
    $houseName = $_POST['houseName'];
    $houseLocation = $_POST['houseLocation'];
    $housePrice = $_POST['housePrice'];
    $houseCategory = $_POST['houseCategory'];
    $houseStatus = $_POST['houseStatus'];
    $facilities = $_POST['facilities'];
    $description = $_POST['description'];
    $houseImage = $_FILES['house_image']['name'];

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['house_image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    if (!in_array($file_extension, $allowed_extension))
    {
        $_SESSION = "You are allowed with only jpg, png, jpeg, and gif";
        header('Location: houseEdit.php');
    }
    else
    {

        if (file_exists("../admin/uploads/house/".$_FILES['house_image']['name'])) 
        {
            $filename = $_FILES['house_image']['name'];
            $_SESSION['status'] = "Image already exist.".$filename;
            header('Location: houseEdit.php');
        }
        else 
        {
            $sql = "INSERT INTO house(houseName,houseLocation,housePrice,houseCategory,houseStatus,house_image,facilities,description) VALUES('$houseName','$houseLocation','$housePrice','$houseCategory','$houseStatus','$houseImage','$facilities','$description')";
            $sql_run = mysqli_query($con, $sql);

            if ($sql_run)
            {
                move_uploaded_file($_FILES["house_image"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image"]["name"]);
                $_SESSION['status'] = "data insert successfully";
                header('Location: houseEdit.php');
            }
            else
            {
                $_SESSION['status'] = "data failed to inserted.";
                header('Location: houseEdit.php');
            }

        }
    }
}
//END ADD HOUSE SECTION
    
//UPDATE HOUSE SECTION
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
            echo '<script>window.location.href = "manageHouse.php";</script>';
       }
       else
        {
            echo "<script type='text/javascript'>alert('House updated failed!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "manageHouse.php";</script>';
       }
    
}

//delete house section
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
            echo '<script>window.location.href = " manageHouse.php";</script>';
        
        }
        else 
        {
            echo "<script type='text/javascript'>alert('House deleted failed!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "manageHouse.php";</script>';
        }
}


//add landlord section
if (isset($_POST['addLandlord'])) 
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $identityNo = $_POST['identityNo'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];

    $query = "INSERT INTO landlord(name,username,identityNo,email,contactNo,address) VALUES ('$name','$username','$identityNo','$email','$contactNo','$address')";
    $query_run = mysqli_query($con, $query);

     if ($query_run) 
    {
         $_SESSION['status'] = "Landlord added successfully.";
        header("Location: landlord.php");
    }
        else{
            $_SESSION['status'] = "Landlord failed to add!";
            header("Location: landlord.php");
        } 
}

//update landlord section
if (isset($_POST['update_landlord']))
{
    $landlordID = $_POST['landlordID'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $identityNo = $_POST['identityNo'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];

    $query = "UPDATE landlord SET name='$name', username='$username', identityNo='$identityNo', email='$email', contactNo='$contactNo', address='$address' WHERE landlordID='$landlordID' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        $_SESSION['status'] = "Landlord updated successfully!";
        header("Location: landlord.php");
    }
    else{
        $_SESSION['status'] = "Landlord failed to update.";
        header("Location: landlord.php");
    }
}

//delete landlord section
if (isset($_POST['DeleteLandlordbtn'])) 
{
   $landlordID = $_POST['delete_id']; 

   $query = "DELETE FROM landlord WHERE landlordID='$landlordID'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
       $_SESSION['status'] = "Landlord delete successfully!";
       header("Location: landlord.php");
   }
   else{
       $_SESSION['status'] = "Landlord failed to delete.";
       header("Location: Landlord.php");
   }
}

//add tenant
if (isset($_POST['addTenant']))
{
    $tenantID = $_GET['tenantID'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $identificationNo = $_POST['identificationNo'];
    $phoneNo = $_POST['phoneNo'];
    $address = $_POST['address'];

    $query = "INSERT INTO tenant(fullName,email,identificationNo,phoneNo,address) VALUES ('$fullName','$email','$identificationNo','$phoneNo','$address')";
    $query_run = mysqli_query($con, $query);

    if ($query_run)
    {
       $_SESSION['status'] = "Tenant added successfully!";
       header("Location: tenant.php");
    }
    else 
    {
        $_SESSION['status'] = "Tenant Failed to Add.";
       header("Location: tenant.php");
    }
}

//update tenant section
if (isset($_POST['update_tenant']))
{
    $tenantID = $_POST['tenantID'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $identificationNo = $_POST['identificationNo'];
    $phoneNo = $_POST['phoneNo'];
    $address = $_POST['address'];


    $query = "UPDATE tenant SET fullName='$fullName', email='$email', identificationNo='$identificationNo', phoneNo='$phoneNo', address='$address' WHERE tenantID='$tenantID' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) 
    {
        $_SESSION['status'] = "Tenant updated successfully!";
        header("Location: tenant.php");
    }
    else{
        $_SESSION['status'] = "Tenant failed to update.";
        header("Location: tenant.php");
    }
}

//delete tenant section

if (isset($_POST['DeleteTenantbtn'])) 
{
   $tenantID = $_POST['delete_id']; 

   $query = "DELETE FROM tenant WHERE tenantID='$tenantID'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
       $_SESSION['status'] = "Tenant delete successfully!";
       header("Location: tenant.php");
   }
   else{
       $_SESSION['status'] = "Tenant failed to delete.";
       header("Location: tenant.php");
   }
}

//manage house advertisement
if(isset($_POST['addAdvertisement']))
{
    $landlordID = $_POST['landlordID'];
    $id = $_POST['id'];
    $houseImage1 = $_FILES['house_image1']['name'];
    $houseImage2 = $_FILES['house_image2']['name'];
    $houseImage3 = $_FILES['house_image3']['name'];
    $houseImage4 = $_FILES['house_image4']['name'];
    $bedrooms = $_POST['bedrooms'];
    $bathroom = $_POST['bathroom'];
    $houseSize = $_POST['houseSize'];
    $parkingNo = $_POST['parkingNo'];
    $facilities = $_POST['facilities'];
    $furnishedType = $_POST['furnishedType'];

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
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
        $_SESSION = "You are allowed with only jpg, png, jpeg, and gif";
        header('Location: houseAds.php');
    }
    else
    {
        $sql = "INSERT INTO  houseadvertisement(landlordID,id,house_image1,house_image2,house_image3,house_image4,bedrooms,bathroom,houseSize,parkingNo,facilities,furnishedType) VALUES('$landlordID','$id','$houseImage1','$houseImage2','$houseImage3','$houseImage4','$bedrooms','$bathroom','$houseSize','$parkingNo','$facilities','$furnishedType')";
        $sql_run = mysqli_query($con, $sql);

        if ($sql_run)
        {
            move_uploaded_file($_FILES["house_image1"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image1"]["name"]);
            move_uploaded_file($_FILES["house_image2"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image2"]["name"]);
            move_uploaded_file($_FILES["house_image3"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image3"]["name"]);
            move_uploaded_file($_FILES["house_image4"]["tmp_name"], "../admin/uploads/house/".$_FILES["house_image4"]["name"]);
            $_SESSION['status'] = "data insert successfully";
            header('Location: houseAds.php');
        }
        else
        {
            $_SESSION['status'] = "data failed to inserted.";
            header('Location: houseAds.php');
        }
    
    }
}
//insert house category
if (isset($_POST['addCategoryBtn'])) {

    $categoryName = $_POST['categoryName'];

    $query = "INSERT INTO housecategory(categoryName) VALUES ('$categoryName')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "House category added successfully!";
        header("Location: categoryHouse.php");
    }
    else {
        $_SESSION['status'] = "House category failed to add!";
        header("Location: categoryHouse.php");
    }

}

//query for delete house category
if (isset($_POST['DeleteCategorybtn'])) 
{
   $id = $_POST['delete_id']; 

   $query = "DELETE FROM housecategory WHERE id='$id'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
       $_SESSION['status'] = "House category delete successfully!";
       header("Location: categoryHouse.php");
   }
   else{
       $_SESSION['status'] = "House category failed to delete.";
       header("Location: categoryHouse.php");
   }
}

//query for update house category
if (isset($_POST['updateCategoryBtn'])) 
{
   $id = $_POST['update_id']; 
   $categoryName = $_POST['categoryName'];
   $query = "UPDATE housecategory SET categoryName='$categoryName' WHERE id='$id'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
       $_SESSION['status'] = "House category update successfully!";
       header("Location: categoryHouse.php");
   }
   else{
       $_SESSION['status'] = "House category failed to update.";
       header("Location: categoryHouse.php");
   }
}
?>