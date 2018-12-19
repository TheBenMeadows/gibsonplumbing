<?php

	require_once('connections/conn_gibson.php'); 

	//echo "Called from ".$_SERVER['HTTP_REFERER'];

	//Called from http://localhost/gibson/home_owners.php

	//error_reporting(E_ALL ^ E_NOTICE);  

	if  (isset($_SERVER['HTTP_REFERER']))

		{

			$where_from = $_SERVER['HTTP_REFERER'];

			//FOR PUBLIC SITE

			//if (($where_from == "http://www.gibsonplumbing.com/res_builder.php") || ($where_from == "http://www.gibsonplumbing.com/home_owner.php") || ($where_from == "http://www.gibsonplumbing.com/commercial.php"))

			//FOR TEST SITE

			if (($where_from == "http://localhost/gibson/res_builder.php") || ($where_from == "http://localhost/gibson/home_owner.php") || ($where_from == "http://localhost/gibson/commercial.php"))

				{

					$contact_id = $_REQUEST['c'];

				}

			else

				{

					header("Location: index.php");

				}

		}

	else

		{

			header("Location: index.php");

		}

	$tablename = "NONE";

/*

	if (!isset($_SESSION))

		{

			session_start();

		}

	$loginFormAction = $_SERVER['PHP_SELF'];

	if (isset($_GET['security']))

		{

			$_SESSION['PrevUrl'] = $_GET['accesscheck'];

		}

	else

		{

			header("Location: grant_contact_permission.php");

		}	

	require_once('_php_files/main_required_files.php');

	$gotoURL = "contact_confirmation.php";

*/

?>





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

	    <link href="css/forms.css" rel="stylesheet" type="text/css" />

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

								<a href="index.php">Home</a><BR />

								<a href="contact_page.php" >Contacts</a><br /> 

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

				<div align="center">

					<div class="b_promo_text">

						

					</div>

				</div>

				<div align="center">

					<div class="b_promo_text">

						Please fill out all fields, then click submit. <BR /> If you want us to get back to you a vaid email id and phone number is required.

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

										<input name="subject" type="hidden" id="subject" value="Web Site Query" />

										<input type="button" name="submit" id="email" value="submit" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo("builders_confirm.php"); ?>' ,'main');return false;" />

										

									    <input name="Submit" id = "email" type="button" tabindex="3" value="SEND" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo($gotoURL); ?>' ,'main');return false;">

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

				<div class="horiz_grad">

					<img src="graphics/metalic_gradient.png" width="100%" height="5" />

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