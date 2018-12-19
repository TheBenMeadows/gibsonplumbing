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
					foreach($name as $his=>$hat)
						{
							echo("Val - ".$his."=".$hat."<BR>");
						}
				}
*/	
 	$message = "";
	$msg = "";
	$Thedate = Date("Y-m-d");
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
							}
							
					}
		}
	//echo("type_request = ".$type_request."<BR><BR>");
	
	$message .= "\nSubject:  ".$subj."\n";
	$msg .= "Subject=".$subj."&"; 
	$message .= "\nFrom:  ".$from."\n";
	$msg .= "From=".$from."&"; 
	$message .= "\nSpecific request.......\n  ".$type_request."\n\n";
	$msg .= "Specific_request=\'".$mess."\'&"; 
	//If the requestor's email is neither null nor blank (space) add the email to the message
	//echo("msg = ".$msg."<BR><BR>");
	if (isset($email_id)) 
		{
			if ($email_id <> "" && $email_id <> " ")
				{
					$message .= "Email ID - ".$email_id."\n";
				}
		}		
	//If the requestor's Phone number is neither null nor blank (space) add the email to the message
	if (isset($ph)) 
		{
			if ($ph <> "" && $ph <> " ")
				{
					$message .= "Phone Number - ".$ph."\n";
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
				}	
		}		
	$message .= "\n".$add_on.$mess."\n\n  END OF MESSAGE!!";
	//Mail the message to the appropriate person based on what is being requested.

/*	if ($subj == "employment")
		{
			$whoto = "jobs@gibsonplumbing.com";
		}
	else if ($subj == "builder")
		{
			$whoto = "builder@gibsonplumbing.com";
		}
	else if ($subj == "warranty")
		{
			$whoto = "warranty@gibsonplumbing.com";
		}		
	else*/ if ($subj != "" && $subj != " ")
		{
			$message .= "\n\nFAILURE FROM GIBSON PLUMBING!!!\n";
			$whoto = "info@gmbcs.com";
		}
 /*
for testing
	echo ("whoto = ".$whoto."<BR>");
	echo("subj = ".$subj."<BR>");
	echo("message = ".$message."<BR><BR>");
	echo("goto = ".$gotoURL."?done=done<BR>");
*/
/*
remove above statement and UNCOMMENT the two statements below when ready to test on line tested*/
	mail ($whoto, $subj, $message);	
	//echo ("goto = ".$gotoURL."<BR><BR>");
?>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gibson Plumbing Home Page<</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/gibson.css" rel="stylesheet" type="text/css" />
	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div align="center">
			<div class="page">
				<div class="top_row">
					<div class="logo_left">
						<img src="graphics/logo_1.png"/>
						</div>
					<div class="holder1">
						<div class="title_1"></div>
						<div class="title_2">
							<img src="graphics/gibson_title.gif"/>
						</div>
					</div>
					<div class="logo_right">
						<img src="graphics/logo_1.png"/>
					</div>
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
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
				<div align="center">
					<table width="100%" border="0">
						<tr> 
							<td colspan="2">
							<div align="center" class="b_promo_text"><font size="4">Request Received <?php echo($Thedate); ?></font></div>
							</td>
						</tr>
						<tr> 
							<td width="5%">&nbsp;</td>
							<td width="95%" align="left">
							<div class="b_promo_text">Please print this page for you records.</div>
							<div class="b_promo_text">Thank you,</div>
							<div class="b_promo_text">Gibson Plumbing </div>
							</td>
						</tr>
						<tr> 
							<td colspan="2">
							<div align="center"><?php 
							/*		foreach($_REQUEST as $name=>$value)
							{
							echo ("Builder Shceduling Request");
							echo ($name." ........ ".$value)."<BR>";
							}
							*/
								echo($message); ?>
							</div>
							</td>
						</tr>
						<tr> 
							<td colspan="2">
							<div align="center"></div>
							</td>
						</tr>
					</table> 
				</div>
				<div class="horiz_grad">
					<img src="graphics/metalic_gradient.png" width="100%" height="10" /></td>
				</div>
			</div>
		</div>
	</body>
</html>

