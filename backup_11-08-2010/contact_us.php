<?php

	session_start();

	require_once('connections/conn_gibson.php'); 

	//echo "Called from ".$_SERVER['HTTP_REFERER'];

	//Called from http://localhost/gibson/home_owners.php

	//error_reporting(E_ALL ^ E_NOTICE);  

	$tablename = "NONE";

	if  (isset($_SERVER['HTTP_REFERER']))

		{

			$where_from = $_SERVER['HTTP_REFERER'];

			//FOR PUBLIC SITE

			//if (($where_from == "http://www.gibsonplumbing.com/res_builder.php") || ($where_from == "http://www.gibsonplumbing.com/home_owner.php") || ($where_from == "http://www.gibsonplumbing.com/commercial.php"))

			//FOR TEST SITE

			//echo("substring 16 = ".substr($where_from, -16)."<BR>");

			//echo("substring 4 = ".substr($where_from, -4)."<BR>");

			if ((substr($where_from, -16) == "contact_page.php") || (substr($where_from, -4) == "c=ho") || (substr($where_from, -4) == "c=rb") || (substr($where_from, -4) == "c=cc"))

				{

					$_SESSION['security_code'] = rand(1000, 9999);

					$contact_id = $_REQUEST['c'];

					//echo ("where_from = ".$where_from."<BR><BR>");

				}

			else

				{

					//echo "set - Called from ".$_SERVER['HTTP_REFERER'];

					header("Location: index.php");

				}

		}

	else

		{

			//echo "not set -Called from ".$_SERVER['HTTP_REFERER'];

			header("Location: index.php");

		}

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

				<div align="center">

					<div class="b_promo_text">

						

					</div>

				</div>

				<div align="center">

					<div class="b_promo_text">

						Please fill out all fields, then click submit. <BR /> If you want us to get back to you a valid email id and phone number are required.

					</div>

				</div>

				<div align="center">

					<form name="builders_form" id="form1" method="post" action="">

						<table width="100%" border="0">

							<tr> 

								<td width="42%"><div class="b_text_bold">

								<div align="right">

									Name:

								</div>

								</div></td>

								<td colspan="2" align="left">

								  <input name="name" type="text" id="name" size="40" />

								</td>

							</tr>

							<tr> 

								<td><div class="b_text_bold">

								<div align="right">

									email ID 

								</div>

								</div></td>

								<td colspan="2" align="left">

									<input name="email" type="text" id="email" size="20" /></td>

							</tr>

							<tr> 

								<td><div align="right" class="b_text_bold">

									Phone Number:

								</div></td>

								<td colspan="2" align="left">

									<input name="phone" type="text" id="phone" size="40" /></td>

							</tr>

							<tr> 

								<td valign="top"> <div align="right" class="b_text_bold">Description of Work Requested:</div></td>

								<td colspan="2" align="left" valign="top">

									<textarea name="message" id="message" cols="40" rows="10"></textarea></td>

							</tr>

							<tr> 

								<td>

									<div align="right"> 

										<input type="button" name="submit" id="email" value="submit" onclick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo("contact_confirm.php"); ?>' ,'main');return false;" />

									</div>

								</td>

								<td width="16%">

										<input name="subject" type="hidden" id="subject" value="Web Site Query" />

										<input name="contact_id" type="hidden"  id="contact_id" value="<?php echo($contact_id) ?>" />

								</td>

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