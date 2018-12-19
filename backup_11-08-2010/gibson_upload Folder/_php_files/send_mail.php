<?php
	/*
	Copyright March, 2004
	This php file is the exclusive property of Glyn Barrows.
	A right to use permission is granted to Christian Heritage Schools
	for use in administering the www.chs-kids.com (Christian Heritage Schools) Web Site
	*/
	/*
	This is a mailer program/php page.  For this to function correctly, the following must happen.
		Required inbound name value pairs must be provided:
			NAME        VALUE
			subject		'anything'
			from		'anything - but it should be a person or company/org name'
			GoToURL 	'the page that is displayed to the user when this function completes.
						NOTE: this is usually the calling page.  The statement below that redirects the user 
							  also adds a name value pair to the URL string; 
							  	sent=sent.
							  This will allow for adding script to the page to which the user is redirected 
							  to display a message box that indicates the mail was sent.	

		Other fields that may be provided:
		NOTE: - the calling page should verify that at least one of 'email, phone, or address' are provided.
				these are not needed for this program to function, however, without at least one, there will be no 
				discernable way to communicate with the sender.
			message		'anything'
			email		an email id.  this will be used to respond back to the sender of this mail
						in other words it is the senders email ID.			phone		should be a valid phone number
			address		'anything'
			city		'anything'
			mail code	'like a US Zip Code'
			type		'anything - this will be used in the last part of this program to determine who gets the message.
	*/
/*
	FOR TESTING
	
			foreach($_POST as $name=>$value)
				{
					echo ("P - ".$name." = ".$value)."<BR>";
				}
			foreach($_GET as $name=>$value)	
				{
					echo ("G - ".$name." = ".$value)."<BR>";
				}
*/ 		
	$message = "";
	$Thedate = Date("Y-m-d");
	$x = 0;
	$GoToURL = "../index.htm";
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
						case "type":
							//Type represents the type of request.  This is used to determine who gets the message 
							foreach($_GET["type"] as $name =>$value)
								{
									//echo("type stuff -- ".$value."<BR>");//.$name." = "
									$type_request .= $value."\n  ";
								}
							//$type = $value;	
							break;
					}
		}
	//echo("type_request = ".$type_request."<BR><BR>");
	
	$message .= "\nSubject:  ".$subj."\n";
	$message .= "\nFrom:  ".$from."\n";
	$message .= "\nSpecific request.......\n  ".$type_request."\n\n";
	//If the requestor's email is neither null nor blank (space) add the email to the message
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
	$message .= "\n".$mess."\n\n  END OF MESSAGE!!";
	//Mail the message to the appropriate person based on what is being requested.

	$whoto = "gbarrows@gmbcs.com;info@gmbcs.com";
	
	if ($subj == "site")
		{
			$whoto = "gbarrows@gmbcs.com,info@gmbcs.com";
		}
	else if ($subj == "hosting")
		{
			$whoto = "info@gmbcs.com";
		}
	else if ($subj == "graphics")
		{
			$whoto = "info@gmbcs.com";
		}	
	else if ($subj != "" && $subj != " ")
		{
			$whoto = "info@gmbcs.com";
		}
		
/*
for testing
*/
/*
echo ("whoto = ".$whoto."<BR>");
echo("subj = ".$subj."<BR>");
echo("message = ".$message."<BR><BR>");
echo("goto = ".$gotoURL."?done=done<BR>");
*/
/*
remove above statement and UNCOMMENT the two statements below when ready to test on line tested*/
	mail ($whoto, $subj, $message);	
	header("Location: ".$gotoURL."?done=done");
?>