<?php
$tablename = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gibson Plumbing Home Page<</title>
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
				<div align="center"><a href="career_opportunities.htm">Back to Career Opportunities</a></div>
				<div align="center">
					<form name="career_form" id="form1" method="post" action="">
						<table width="100%" height="287" border="0">
							<tr> 
								<td colspan="2"><div align="center" class="b_promo_text">Personal 
								Information: </div></td>
								<td colspan="2"><div align="center" class="b_promo_text">Professional 
								Information: </div></td>
							</tr>
							<tr>
								<td width="21%"><div align="right" class="b_text">First Name: </div></td>
								<td width="29%"><input name="First Name" type="text" id="FName" size="30" tabindex="1" /></td>
								<td width="19%"><div align="right" class="b_text">Job applying for: </div></td>
								<td width="31%"><input name="Job" type="text" id="Job" size="30" tabindex="3" /></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">Last Name: </div></td>
								<td><input name="Last Name" type="text" id="LName" size="30"  tabindex="2"/></td>
								<td><div align="right" class="b_text">Desired salary: </div></td>
								<td><input name="Salary" type="text" id="Salary" size="20" tabindex="4" /></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">Daytime Phone: </div></td>
								<td><input name="Day Phone" type="text" id="DayPhone" size="30" tabindex="5"/></td>
								<td><div align="right" class="b_text">Availability date: </div></td>
								<td><input name="ADate" type="text" id="ADate" size="20" tabindex="6" /></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">Evening Phone: </div></td>
								<td><input name="Evening Phone" type="text" id="EPhone" size="30" tabindex="7" /></td>
								<td><div align="right" class="b_text">List work experience:</div></td>
								<td rowspan="6"><textarea name="Work Experience" cols="35" rows="10" id="WorkExp" tabindex="13"></textarea></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">Address: </div></td>
								<td><input name="Address" type="text" id="Address" size="30" tabindex="8" /></td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">City: </div></td>
								<td><input name="City" type="text" id="City" size="30" tabindex="9" /></td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">State: </div></td>
								<td><input name="State" type="text" id="State" size="4" tabindex="10" /></td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">Zip: </div></td>
								<td><input name="Zip" type="text" id="Zip" size="10" tabindex="11"/></td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text">E-mail: </div></td>
								<td>
								<input name="Email" type="text" id="Email" size="30" tabindex="12" />
								<input name="email_subj" type="hidden" id="email_subj" value="Employment Opportunities Request" />
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr> 
								<td>&nbsp;</td>
								<td>
								<div align="left">
									<input type="button" name="submit" id="email" value="submit" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo("career_opportunities.htm"); ?>' ,'main');return false;" />
								</div>
								</td>
								<td>
									<div align="right" class="b_text">
										<input name="reset" type="reset" id="reset" value="reset" />
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