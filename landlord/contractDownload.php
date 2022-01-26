<?php
if(!empty($_GET['contract'])){
    $fileName  = basename($_GET['contract']);
    $filePath = "../landlord/uploads/contract/".$fileName;
    
    if(!empty($fileName) && file_exists($filePath)){
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
}

?>