<?php
require('../fpdf184/fpdf.php');
include('../db_connect.php');

if (isset($_GET['paymentID'])) 
{
    $paymentID = $_GET['paymentID'];

}

//get invoice data
$query = mysqli_query($con, "SELECT * FROM payment INNER JOIN rental ON payment.tenantID=rental.tenantID INNER JOIN houses ON rental.houseID=houses.houseID WHERE paymentID='$paymentID'");
//pass the object into array
$invoice = mysqli_fetch_array($query);
$query_tenant = mysqli_query($con,"SELECT * FROM payment INNER JOIN tenant ON payment.tenantID=tenant.userID WHERE paymentID='$paymentID'");
$invoice2 = mysqli_fetch_array($query_tenant);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 12);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'HRAS.CO ',0,0);
$pdf->Cell(59	,5,'MONTHLY RENT INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Times','',12);

$pdf->Cell(130	,5,'Level 13, Block A, Menara Prima',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Jalan 1/37, Dataran Prima,',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'47301 Petaling Jaya, Selangor',0,0);
$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer

$pdf->Line(10,30,200,30);

//billing address
$pdf->SetFont('Times','B',12);
$pdf->Cell(130	,5,'Invoice to:',0,0);
$pdf->Cell(100  ,5,'Billing Details:',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->SetFont('Times','',12);

$pdf->Cell(130	,5,$invoice['tenantName'] ,0,0);
$pdf->Cell(23	,5,'Ref No',0,0);
$pdf->Cell(34	,5, ''.$invoice['refNo'],0,1);//end of line
//end of line

$pdf->Cell(130	,5,$invoice2['phoneNo'],0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,$invoice['tenantEmail'],0,0);
$pdf->Cell(25	,5,'Issued Date',0,0);
$pdf->Cell(34	,5,date('d-m-20y'),0,1);//end of line

$pdf->Cell(130	,5,$invoice['address1'],0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(34	,5,'RM '.$invoice['rentalPaid'],0,1);//end of line

$pdf->Cell(130	,5,$invoice['postcode'].','.$invoice['district'].','.$invoice['state'],0,0);
$pdf->Cell(25	,5,'House Type',0,0);
$pdf->Cell(34	,5,''.$invoice['category'],0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Status',0,0);
$pdf->Cell(34	,5,$invoice['statusPayment'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Times','B',12);

$pdf->Cell(10	,5,'#',1,0);
$pdf->Cell(145	,5,'Description',1,0);
$pdf->Cell(34	,5,'Amount',1,1,'R');//end of line

$pdf->SetFont('Times','',12);
//items
$query=mysqli_query($con,"select * from payment where paymentID = '".$invoice['paymentID']."'");
$tax=0;
$amount=0;
$duePayment=$invoice['rentalPaid']-$invoice['amountPay'];

while($item=mysqli_fetch_array($query)){
    $pdf->Cell(10	,5,'1',1,0);
	$pdf->Cell(145	,5,'House Rent '.$invoice['houseName'],1,0);
	$pdf->Cell(34	,5,'RM '.number_format($item['amountPay']),1,1,'R');//end of line
    $pdf->Cell(10	,5,'2',1,0);
	$pdf->Cell(145	,5,'Previous Month Balance ',1,0);
	$pdf->Cell(34	,5,'RM '.number_format($duePayment),1,1,'R');//end of line
	$tax+=$item['amountPay'];
	$amount+=$item['amountPay'];
}

//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(9	,5,'RM',1,0);
$pdf->Cell(25	,5,number_format($amount),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total',0,0);
$pdf->Cell(9	,5,'RM',1,0);
$pdf->Cell(25	,5,number_format($amount + $duePayment),1,1,'R');//end of line

$pdf->Ln( 16 );
$pdf->SetFont( 'Times', '', 11);
$pdf->Write( 6, "1. This invoice does not capture any overpayment done earlier.");
$pdf->Ln( 6 );
$pdf->Write( 6, "2. Should you require any further information, please feel free to contact our team.");
$pdf->Ln( 6 );
$pdf->Write( 6, "3. Please make all invoice payment to us by online banking or cash deposit.");
$pdf->SetFont( 'Times', 'I', 11 );
$pdf->Ln( 10 );
$pdf->Write( 6, "This is a computer generated invoice and signature is not required" );


$pdf->Output();
 ?>