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

 	$message = "";

	$msg = "";

	$Thedate = Date("m-d-Y");

	$x = 0;

	$goToURL = "../index.htm";

	$add_on - "";

	$add_on_a = "";

	$message_conf = "";

	foreach($_GET as $name=>$value )

		{

				switch ($name) 

					{

						case "subject":

							$subj = $value;

							break;    

						case "name":

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

						case "date":

							$a_date = $value;

						case "submit":

						case "reset":

							break;

						case "type":

							//Type represents the type of request.  This is used to determine who gets the message 

							foreach($_GET["type"] as $name =>$value)

								{

									//echo("type stuff -- ".$value."<BR>");//.$name." = "

									$type_request .= $value."\n  ";

								}

							//$type = $value;	

							break;

						default :

							{

								$add_on .= $name.":  ".$value."\n";

								$add_on_a .= $name.":  ".$value."<BR>";

							}

							

					}

		}

	//echo("type_request = ".$type_request."<BR><BR>");

	$message .= "\nSubject:  ".$subj."\n";

	$message_conf .= chr(13).chr(13)."Subject:  ".$subj.chr(13);

	$msg .= $subj."<BR>";

	if (isset($from))

		{

			$message .= "\nFrom:  ".$from."\n";

			$message_conf .= "From:  ".$from.chr(13);

			$msg .= "From: ".$from."<BR>";

		}

	if (isset($a_date))

		{

			$message .= "\nRequested date: ".$a_date."\n";

			$message_conf .= "Requested date: ".$a_date.chr(13);

			$msg .= "<BR>Requested date: ".$a_date."<BR><BR>";

		}

	if (isset($type_request))

		{

			$message .= "\nType of request.......\n  ".$type_request."\n\n";

			$message_conf .= "Type of request.......".chr(13).$type_request.chr(13);

			$msg .= "Type of request: <BR>".$type_request."<BR><BR>"; 

		}

	if (isset($mess))

		{

			$message .= "\nRequest:\n".$mess."\n\n";

			$message_conf .= "Request:".chr(13).$mess.chr(13);

			$msg .= "Request:<BR>".$mess."<BR><BR>";

		}

	//If the requestor's email is neither null nor blank (space) add the email to the message

	//echo("msg = ".$msg."<BR><BR>");

	if (isset($email_id)) 

		{

			if ($email_id <> "" && $email_id <> " ")

				{

					$message .= "Email ID - ".$email_id."\n";

					$message_conf .= "Email ID - ".$email_id.chr(13);

					$msg .= "Email ID - ".$email_id."<BR>";

				}

		}		

	//If the requestor's Phone number is neither null nor blank (space) add the email to the message

	if (isset($ph)) 

		{

			if ($ph <> "" && $ph <> " ")

				{

					$message .= "Phone Number - ".$ph."\n";

					$message_conf .= "Phone Number - ".$ph.chr(13);

					$msg .= "Phone Number - ".$ph."<BR>";

				}

	//If the requestor's address is neither null nor blank (space) add the email to the message

		}		

	if (isset($addr)) 

		{

			if ($addr <> "" && $addr <> " ")

				{

					$message .= "Address:\n";

					$message .= "    ".$addr."\n";

					$message .= "    ".$city."\n";

					$message .= "    ".$mc."\n";

					$message_conf .= "Address:".chr(13);

					$message_conf .= "    ".$addr.chr(13);

					$message_conf .= "    ".$city.chr(13);

					$message_conf .= "    ".$mc.chr(13);

					$msg .= "Address:<BR>";

					$msg .= "    ".$addr."<BR>";

					$msg .= "    ".$city."<BR>";

					$msg .= "    ".$mc."<BR>";

				}	

		}		

	$message .= $add_on."\n\n  END OF MESSAGE!!";

	$message_conf .= chr(13)."**************END OF MESSAGE******************".chr(13);

	$msg .= $add_on_a."<BR><BR>";

	//Mail the message to the appropriate person based on what is being requested.

	if ($subj != "" && $subj != " ")

		{

			//$whoto = "Dvaughn@GibsonPlumbing.com";

			if (isset($_REQUEST['form']) && ($_REQUEST['form'] == "career_form"))

				{

					$whoto .= "JRuiz@GibsonPlumbing.com,Tnoto@GibsonPlumbing.com";

					$headers = "From: Employment_Request_form@gibsonplumbing.com\r\n";

				}

			else

				{

/**/

					$whoto .= "customercare@GibsonPlumbing.com,";

					$whoto .= "Dvaughn@GibsonPlumbing.com,Shernandez@GibsonPlumbing.com,ldeluna@gibsonplumbing.com,Mrodriguez@GibsonPlumbing.com,Jlaw@gibsonplumbing.com,Jbartlett@gibsonplumbing.com,bsanders@gibsonplumbing.com";

					$headers = "From: Builder_Request_form@gibsonplumbing.com.com\r\n";

				}

			$whoto .= ",info@gmbcs.com";

			//echo("Mail function next ".$_REQUEST['form']);

			//echo ($whoto.",".$subj.",".$message.",".$headers);

			$success = mail ($whoto, $subj, $message, $headers);

		}

	//

/*append the message to be sent to the builder to a log file for today's date */

/*

$filename = "logfiles/".$Thedate."_logfile-builder_confirms.txt";

$file = fopen($filename, "a+");

fwrite($file, $message_conf);

fclose($file);

chmod($filename, 0777);

*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing Builder Confirmation</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<script language="javascript" src = "_javascript/_process_form.js" type="text/JavaScript"></script>

		<script language="javascript" src = "_javascript/_form_actions.js" type="text/JavaScript"></script>		

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

	</head>

	<body background="images/metal_1a_20.jpg">

		<div align="center">

			<div class="page">

				<div class="top_row">

					<div class="logo_left">

						<img src="graphics/The Dude_TOP.jpg" width="250" height="143"/>

					</div>

					<div class="holder1">

						<div class="title_1">&nbsp;</div>

						<div class="title_2 ">

								Maintenance

						</div>

					</div>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>

				</div>

				<div class="navbar">

					<a href="index.php">Home</a> | 

					<a href="residential.php">Residential</a> | 

					<a href="commercial.php" >Commercial</a> | 

					<a href="career_opportunities.htm" >Careers</a> | 

					<a href="about_us.php" >About Us</a> | 

					<a href="contact_page.php" >Contacts</a><br /> 

					<A href="javascript:void window.open('get_directions.htm', 'directions', 'height=300px, width= 450px')">

						Get Directions

					</A>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>

				</div>

<?php

	if ($success)

		{

?>				

				<table width="100%" border="0">

					<tr> 

						<td width="5%">&nbsp;</td>

						<td width="95%" align="left">

							<div class="b_promo_text">Please print this page for your records.</div>

							<div class="b_promo_text">Thank you,</div>

							<div class="b_promo_text">Gibson Plumbing </div>

						</td>

					</tr>

					<tr>

						<td>&nbsp;</td>

						<td>&nbsp;</td>

					</tr>

					<tr> 

						<td colspan="2">

							<div align="center" class="b_promo_text">Request Received <?php echo($Thedate); ?></div>

						</td>

					</tr>

					<tr> 

						<td width="25%">&nbsp;</td>

						<td>

							<div class="b_promo_text">

								<?php echo($msg); ?>

							</div>

						</td>

					</tr>

					<tr> 

						<td colspan="2">

							<div align="center"></div>

						</td>

					</tr>

					<tr>

						<td colspan="3"><img src="graphics/metalic_gradient.png" width="100%" height="10" /></td>

					</tr>

				</table>

<?php

		}

	else

		{

?>

				<div align="center">

					This request was not able to post.  Please resubmit.

				</div>

<?php

		}

?>				

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



