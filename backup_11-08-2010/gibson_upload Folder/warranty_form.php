<?php
$tablename = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gibson Plumbing Home Page<</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/gibson.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src = "_javascript/_process_form.js" type="text/JavaScript"></script>
		<script language="javascript" src = "_javascript/_form_actions.js" type="text/JavaScript"></script>		
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
		        <div align="center">
					<a href="warranty.php">Back to Warranty &amp; Service</a>
				</div>
				<div align="center">
					<form name="form1" id="form1" method="post" action="">
						<table width="100%" height="306" border="0">
							<tr> 
								<td width="21%"><div align="right">First Name: </div></td>
								<td width="29%" align="left"><input name="First Name" type="text" id="First_Name" size="30" tabindex="1" /></td>
								<td width="19%"><div align="right">Project (subdivision): </div></td>
								<td width="31%" align="left"><input name="Subdivision" type="text" id="subdivision" size="30" tabindex="3" /></td>
							</tr>
							<tr> 
								<td><div align="right">Last Name: </div></td>
								<td align="left"><input name="Last Name" type="text" id="Last_Name" size="30" tabindex="2" /></td>
								<td align="right"><div align="right">
								<p>Move In Date :</p>
								</div></td>
								<td align="left"><input name="Move in date" type="text" id="move_in_date" size="20" tabindex="4" /></td>
							</tr>
							<tr> 
								<td height="27"><div align="right">Daytime Phone: </div></td>
								<td align="left"><input name="Daytime Phone" type="text" id="Daytime_Phone" size="30" tabindex="5" /></td>
								<td rowspan="3" valign="top"> <div align="right">Description of service requested:</div>
								<div align="right"></div></td>
								<td rowspan="5" align="left" valign="top"><textarea name="Service Requested" cols="34" rows="9" id="Service" tabindex="13"></textarea></td>
							</tr>
							<tr> 
								<td><div align="right">Evening Phone: </div></td>
								<td align="left"><input name="Evening Phone" type="text" id="Evening_Phone" size="30" tabindex="6" /></td>
							</tr>
							<tr> 
								<td height="25"><div align="right">Address: </div></td>
								<td align="left"><input name="Address" type="text" id="Address" size="30" tabindex="7" /></td>
							</tr>
							<tr> 
								<td><div align="right">City: </div></td>
								<td align="left"><input name="City" type="text" id="City" size="30" tabindex="8" /></td>
								<td rowspan="2"><div align="right"></div></td>
							</tr>
							<tr> 
								<td height="24"><div align="right">State: </div></td>
								<td align="left"><input name="State" type="text" id="State" size="4" tabindex="9" /></td>
							</tr>
							<tr> 
								<td height="24"><div align="right">Zip: </div></td>
								<td align="left"><input name="Zip" type="text" id="Zip" size="10" tabindex="10" /></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td><div align="right">E-mail: </div></td>
								<td align="left"><input name="Email" type="text" id="Email" size="30" tabindex="11" /></td>
								<td><div align="right">Date requested:</div></td>
								<td align="left"><input type="text" name="date" tabindex="12" /></td>
							</tr>
							<tr> 
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr> 
								<td>&nbsp;</td>
								<td> 
									<div align="left"> 
										<input name="email_subj" type="hidden" id="email_subj" value="Warranty Service Request" />
										<input type="button" name="submit" id="email" value="submit" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo("warranty.htm"); ?>' ,'main');return false;" />
									</div>
								</td>
								<td>
									<div align="right"> 
										<input name="Reset" type="reset" id="Reset" value="Reset" />
									</div>
								</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="horiz_grad">
					<img src="graphics/metalic_gradient.png" width="100%" height="10" />
				</div>
			</div>
		</div>
	</body>
</html>
					
