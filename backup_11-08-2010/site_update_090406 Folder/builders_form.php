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
				<div align="center">
					<div class="b_promo_text">
						<font color="#FF0000">Warranty Items are not to be entered on this form!</font>
					</div>
				</div>
				<div align="center">
					<div class="b_promo_text">
						Please fill out all fields, then click submit.&nbsp; You will be contacted if there is a conflict with the date you requested.
					</div>
				</div>
				<div align="center">
					<form name="builders_form" id="form1" method="post" action="">
						<table width="100%" border="0">
							<tr> 
								<td width="42%"><div class="b_text_bold">
								<div align="right">Builder:</div>
								</div></td>
								<td colspan="2" align="left">
								  <input name="Builder" type="text" id="Builder" size="40" />
								</td>
							</tr>
							<tr> 
								<td><div class="b_text_bold">
								<div align="right">Date Requested:</div>
								</div></td>
								<td colspan="2" align="left"><input name="date" type="text" id="date" size="20" /></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text_bold">Submitted By:</div></td>
								<td colspan="2" align="left"><input name="name" type="text" size="40" /></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text_bold">Address Where Work 
								Is To Be Performed:</div></td>
								<td colspan="2" align="left"><input name="address" type="text" size="40" /></td>
							</tr>
							<tr> 
								<td valign="top"> <div align="right" class="b_text_bold">Description of Work Requested:</div></td>
								<td colspan="2" align="left" valign="top"> <textarea name="message" cols="40" rows="10"></textarea></td>
							</tr>
							<tr> 
								<td><div align="right" class="b_text_bold">Job Superintendent 
								Phone Number:</div></td>
								<td colspan="2" align="left">
								<input name="email_subj" type="hidden" id="email_subj" value="Builder Scheduling Request" />
								<input name="Phone Number" type="text" id="Phone Number" />
								</td>
							</tr>
							<tr> 
								<td>
									<div align="right"> 
										<input type="button" name="submit" id="email" value="submit" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo("builders_confirm.php"); ?>' ,'main');return false;" />
									</div>
								</td>
								<td width="16%">&nbsp;</td>
								<td width="42%" align="left">
								<input name="reset" type="reset" id="reset" value="reset" /></td>
							</tr>
							<tr> 
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
					</form>
				</div>	
				<div align="center">
					<a href="builders.php">Builders Page</a>
				</div>
				<div class="horiz_grad">
					<img src="graphics/metalic_gradient.png" width="100%" height="10" />
				</div>
			</div>
		</div>
	</body>
</html>