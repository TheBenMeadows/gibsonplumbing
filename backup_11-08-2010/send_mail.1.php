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
	$msg .= $subj."<BR>";
	if (isset($from))
		{
			$message .= "\nFrom:  ".$from."\n";
			$msg .= "From: ".$from."<BR>";
		}
	if (isset($a_date))
		{
			$message .= "\nRequested date: ".$a_date."\n";
			$msg .= "<BR>Requested date: ".$a_date."<BR><BR>";
		}
	if (isset($type_request))
		{
			$message .= "\nType of request.......\n  ".$type_request."\n\n";
			$msg .= "Type of request: <BR>".$type_request."<BR><BR>"; 
		}
	if (isset($mess))
		{
			$message .= "\nRequest:\n".$mess."\n\n";
			$msg .= "Request:<BR>".$mess."<BR><BR>";
		}
	//If the requestor's email is neither null nor blank (space) add the email to the message
	//echo("msg = ".$msg."<BR><BR>");
	if (isset($email_id)) 
		{
			if ($email_id <> "" && $email_id <> " ")
				{
					$message .= "Email ID - ".$email_id."\n";
					$msg .= "Email ID - ".$email_id."<BR>";
				}
		}		
	//If the requestor's Phone number is neither null nor blank (space) add the email to the message
	if (isset($ph)) 
		{
			if ($ph <> "" && $ph <> " ")
				{
					$message .= "Phone Number - ".$ph."\n";
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
					$msg .= "Address:<BR>";
					$msg .= "    ".$addr."<BR>";
					$msg .= "    ".$city."<BR>";
					$msg .= "    ".$mc."<BR>";
				}	
		}		
	$message .= $add_on."\n\n  END OF MESSAGE!!";
	$msg .= $add_on_a."<BR><BR>";
	//Mail the message to the appropriate person based on what is being requested.
	if ($subj != "" && $subj != " ")
		{
			$whoto = "Shernandez@GibsonPlumbing.com,Ktschoepe@GibsonPlumbing.com,Mrodriguez@GibsonPlumbing.com,Dvaughn@GibsonPlumbing.com";
			$whoto .= ",info@gmbcs.com";
		}
	mail ($whoto, $subj, $message);	
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
	<body>
		<div align="center">
			<div class="page">
				<div class="top_row">
					<div class="logo_left">
						<img src="graphics/logo_1.png"/>						</div>
					<div class="holder1">
						<div class="title_1"></div>
						<div class="title_2">
							<img src="graphics/gibson_title.gif"/>						</div>
					</div>
					<div class="logo_right">
						<img src="graphics/logo_1.png"/>					</div>
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
				<div class="navbar">
					<a href="index.htm">Home</a> |
					<a href="maintenance.php">Maintenance</a> | 
					<a href="warranty.php">Warranty &amp; Service</a> | 
					<a href="about_us.php">About Us</a> | 
					<a href="contact_page.php">Contacts</a> | 
					<a href="career_opportunities.htm">Careers</a> | 
					<a href="builders.php">Builders Page </a> | 
					<a href="project_tracker.htm">Project Tracker</a>
					<br />
					<br />
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
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
			</div>
		</div>
	</body>
</html>

