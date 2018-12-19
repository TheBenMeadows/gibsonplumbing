<?php

/*

	FOR TESTING

			foreach($_POST as $name=>$value)

				{

					echo ("P - ".$name." = ".$value."<BR>");

				}

			foreach($_GET as $name=>$value)	

				{

					echo ("G - ".$name." = ".$value."<BR>");

				}

*/	

	$where_from = $_SERVER['HTTP_REFERER'];

 	$message = "";

	$message_show = "";

	$msg = "";

	$Thedate = Date("Y-m-d");

	$x = 0;

	$goToURL = "../index.htm";

	$add_on = "";

	$from = "";

	$type_request = "";

	$whoto = "";

	$headers = "";

	foreach($_REQUEST as $name=>$value )

		{

				switch ($name) 

					{

						case "subject":

							$subj = $value;

							break;    

						case "name":

						case "Name":

							$from = $value;

							break;

						case "email":

							$email_id = $value;

							break;	    

						case "message":

							$mess = $value;

							break;    

						case "phone":

							$ph = $value;

							break;

						case "address":

							$addr = $value;

							break;

						case "city":

							$city = $value;

							break;

						case "mail_code":

							$mc = $value;

							break;

						case "gotoURL":

							$gotoURL = $value;

							break;

						case "email_subj":

							$subj = $value;

							break;

						case "submit":

						case "reset":

							break;

						case "type":

							//Type represents the type of request.  This is used to determine who gets the message 

							foreach($_REQUEST["type"] as $name =>$value)

								{

									$type_request .= $value."\n  ";

								}

							break;

						case "contact_id":

							{

								switch ($value) 

									{

										case 1:

										case"1":

											{

												$whoto = "Bbankler@GibsonPlumbing.com";

												break;

											}

										case 2:

										case "2":

											{

												$whoto = "Bbartley@GibsonPlumbing.com";

												break;

											}

										case 3:

										case "3":

											{

												$whoto = "Cnorton@GibsonPlumbing.com";

												break;

											}

										case 4:

										case "4":

											{

												$whoto = "Dvaughn@GibsonPlumbing.com";

												break;

											}

										case 5:

										case "5":

											{

												$whoto = "Jlaw@GibsonPlumbing.com";

												break;

											}

										case 6:

										case "6":

											{

												$whoto = "Jmurray@GibsonPlumbing.com";

												break;

											}

										case 7:

										case "7":

											{

												$whoto = "JRMurray@GibsonPlumbing.com";

												break;

											}

										case 8:

										case "8":

											{

												$whoto = "Mmcalexander@GibsonPlumbing.com";

												break;

											}

										case 9:

										case "9":

											{

												$whoto = "Mspiekerman@GibsonPlumbing.com";

												break;

											}

										case 10:

										case "10":

											{

												$whoto = "Rvasquez@GibsonPlumbing.com";

												break;

											}

										case 11:

										case "11":

											{

												$whoto = "Rmoore@GibsonPlumbing.com";

												break;

											}

										default:

											{

												break;

											}

									}

								

							}

					}

		}

//For testing ---  uncomment the following line

	//$whoto = "info@gmbcs.com";

	

	if (($subj =="") || ($subj == " "))

		{

			$subj == "message created from ".$where_from;

		}

	$message .= "\nSubject:  ".$subj."\n\n";

	$message_show .= "<BR>Subject:  ".$subj."<BR><BR>";

	$msg .= "Subject=".$subj."&"; 

	$message .= "\nFrom:  ".$from."\n\n";

	$message_show .= "<BR>From:  ".$from."<BR><BR>";

	$msg .= "From=".$from."&"; 

	//If the requestor's email is neither null nor blank (space) add the email to the message

	//echo("msg = ".$msg."<BR><BR>");

	if (isset($email_id)) 

		{

			if ($email_id <> "" && $email_id <> " ")

				{

					$message .= "Email ID:  ".$email_id."\n\n";

					$message_show .= "Email ID:  ".$email_id."<BR>";

					$headers = 'From:'.$email_id. "\n";

					$headers .= 'BCC: glyn@gmbcs.com';

				}

		}		

	//If the requestor's Phone number is neither null nor blank (space) add the email to the message

	if (isset($ph)) 

		{

			if ($ph <> "" && $ph <> " ")

				{

					$message .= "Phone Number:  ".$ph."\n\n";

					$message_show .= "Phone Number:  ".$ph."<BR>";

				}

			//If the requestor's address is neither null nor blank (space) add the email to the message

			//$headers .= 'Bcc: gbarrows@gmbcs.com';

		}		

	$message .= "\nMessage:  ".$mess."\n\n";

	$message_show .= "<BR>Message sent to ".$whoto.":<BR><BR>  ".$mess."<BR><BR>";

	$msg .= "Specific_request=\'".$mess."\'&"; 

	$message .= "\n\n  END OF MESSAGE!! \n";

	//Mail the message to the appropriate person based on what is being requested.

 /*

for testing

	echo ("whoto = ".$whoto."<BR>");

	echo("subj = ".$subj."<BR>");

	echo("message = ".$message."<BR><BR>");

	echo("goto = ".$gotoURL."?done=done<BR>");

*/

/*

	remove next statement when ready to do a live test 

*/

	$message_show .= "<BR>END OF MESSAGE<BR>";

/*	

	echo ("whoto ===> ".$whoto."<BR>");

	echo ("subj ===> ".$subj."<BR>");

	echo ("add_on ===> ".$add_on."<BR><BR>");

	echo ("message ===> ".$message."<BR><BR>");

	echo ("mail (".$whoto. $subj. $message."<BR><BR>");

*/

/**/

	mail ($whoto, $subj, $message, $headers);	



/*append the message to be sent to the builder to a log file for today's date 

$filename = $Thedate."_logfile-builder_confirm.txt";

$file = fopen($filename, "a+");

fwrite($file, $message);

fclose($file);*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing Confirmation<</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/contact_confirm.css" rel="stylesheet" type="text/css" />

	</head>

	<body background="images/pipes-5.gif" >

		<div  align="center">	

			<div class="page">

				<!--

					<div align="left">

					<div align="right">

				-->

					<div class="top_row">

						<div class="logo">

							<div align="left">

								<a href="index.php">Home</a><BR /><BR />

								<a href="contact_page.php" >Contacts</a><BR /><BR />

								<a href="about_us.php" >About Us</a> | 

							

<?php

 	//include_once("inc/nav_bar_vert_small.php");

?>

							</div>

						</div>

<!--

					</div>

-->

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="confirm_body">

					<div class="confirm_left_side_space">

					</div>

					

						<div class="confirm_title_text_row">&nbsp;</div>

						<div class="confirm_title_row">Request Received <?php echo($Thedate); ?></div>

						<div class="confirm_title_text_row">&nbsp;</div>

						<div class="confirm_title_text_row">Please print this page for you records.</div>

						<div class="confirm_title_text_row">Thank you,</div>

						<div class="confirm_title_text_row">Gibson Plumbing </div>

						<div class="confirm_title_text_row">&nbsp;</div>

						<div class="confirm_message_block">

										<?php echo($message_show); ?>

						</div>

				</div>

				<div class="horiz_grad">

					<img src="graphics/metalic_gradient.png" width="100%" height="5" /></td>

				</div>

			</div>

		</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-18445742-1");
pageTracker._trackPageview();
} catch(err) {}</script>


	</body>

</html>



