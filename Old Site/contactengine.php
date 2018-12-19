<?php
if(isset($_POST['submit'])){
$to = "customercare@gibsonplumbing.com";
$Subject = "Schedule Phase Work";
$headers = 'From: Gibson Plumbing <'.$to.'>' . "\r\n";
$headers .= "Bcc: brittany@robotcreative.com \r\n"; 

$builder = Trim(stripslashes($_POST['builder'])); 
$submittedby = Trim(stripslashes($_POST['submittedby'])); 
$purchase = Trim(stripslashes($_POST['purchase'])); 
$work = Trim(stripslashes($_POST['work'])); 
$workrequested = $_POST['workrequested']; 
$comment = Trim(stripslashes($_POST['comments']));
$superintendent = Trim(stripslashes($_POST['superintendent'])); 
//$headers = 'From: Gibson Plumbing <'.$EmailTo.'>' . "\r\n";

// prepare email body text
$Body = "";
$Body .= "Builder: ";
$Body .= $builder;
$Body .= "\n";
$Body .= "Submitted by: ";
$Body .= $submittedby;
$Body .= "\n";
$Body .= "Purchase Order number: ";
$Body .= $purchase;
$Body .= "\n";
$Body .= "Address where work is to be performed: ";
$Body .= $work;
$Body .= "\n";
$Body .= "\n";
$Body .= "Work Requested: ";
$Body .= $workrequested;
$Body .= "\n";
$Body .= "\n";
$Body .= "Additional Comments: ";
$Body .= $comment;
$Body .= "\n";
$Body .= "\n";
$Body .= "Job Superintendent phone number: ";
$Body .= $superintendent;
$Body .= "\n";

// send email 
$success = mail($to, $Subject, $Body, $headers);

//header("Location: submission_confirmation.php");
//$success = mail($EmailTo, $Subject, $Body, $headers");

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=submission_confirmation.php\">";

} else {

echo "Sorry error please try again..."; 

}

}
?>	
<?php
// send email 
//mail($EmailTo, $Subject, $Body, $headers);
//$success = mail($EmailTo, $Subject, $Body, $headers");
// redirect to success page 
/*if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.php\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
}*/
?>