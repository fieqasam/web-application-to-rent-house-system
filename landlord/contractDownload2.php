<?php
 if (!empty($_GET['filePayment'])) {

  $fileName = basename($_GET['filePayment']);
  $filePath  = "../landlord/uploads/payment/".$fileName;
                        
  if (!empty($fileName) && file_exists($filePath)) {
       //define header
   header("Cache-Control: public");
   header("Content-Description: File Transfer");
   header("Content-Disposition: attachment; fileName=$fileName");
   header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
                             
   //read file 
   readfile($filePath);
   exit;
  }
  else {
      echo "file not exist";
  }
}
else{
  echo "file not exist";
}
?>
