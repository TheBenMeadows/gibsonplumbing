<?php 

	require_once('connections/conn_gibson.php'); 

	//echo "Called from ".$_SERVER['HTTP_REFERER'];

	//echo ("<BR><BR>".substr($_SERVER['HTTP_REFERER'], 44));

	//Called from http://localhost/gibson/home_owners.php

	if (isset( $_SERVER['HTTP_REFERER']))

		{

			$where_from = $_SERVER['HTTP_REFERER'];

			if (isset($_REQUEST['c']))

				{

					$qs_val = $_REQUEST['c'];

				}

			else

				{

					$qs_val = "oops";

				}

			if ((substr($where_from, -15) == "home_owners.php") || ($qs_val == "ho"))

				{

					$scrub = 1;

				}

			else if  ((substr($where_from, -16) == "res_builders.php") || ($qs_val == "rb") || (substr($where_from, 0,44)== "http://localhost/gibson/builders_confirm.php"))

				{

					$scrub = 2;

				}

			else if ((substr($where_from, -14) == "commercial.php") || ($qs_val == "cc")  || (substr($where_from, -12) == "about_us.php"))

				{

					$scrub = 3;

				}

			else if  ((substr($where_from, -17) == "builders_form.php") || ($qs_val == "rb"))

				{

					$scrub = 2;

				}

			else

				{

					//for use later as a generic contact option. or to check abuse, since this is only active when an external hack is employed

					$scrub = 999;

				}

		}

	else

		{

			header("Location: index.php");

		}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing Contact</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

		<link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

	</head>

	<body background="images/pipes-5.gif" >

		<div  align="center">	

			<div class="page">

					<div align="right">

						<div class="logo_left">

<?php

 	//include_once("inc/nav_bar_vert_small.php");

?>

<?php 

	if ($scrub ==1)

		{

?>				

							<img src="images/Bankler_4.png" height="165"/>

<?php

		}

	else if ($scrub ==2)

		{

?>

							<img src="images/Bankler_2.png" height="165"/>

<?php

		}

	else if ($scrub ==3)

		{

?>

							<img src="images/Bankler_3.png" height="165"/>

<?php

		}

?>

						</div>

						<div class="logo">

							<div align="left"><BR />

								<a href="index.php">Home</a><BR /><BR />

								<a href="about_us.php" >About Us</a>

							

<?php

 	//include_once("inc/nav_bar_vert_small.php");

?>

							</div>

						</div>

<!--

					</div>

-->

				</div>

				<BR />

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="contacttext1">

					<div class="b_promo_text">

								5511 Dietrich Road <br />

								San Antonio, Texas 78219

					</div>

				</div>

				<div class="contacttext2">

					<div class="b_promo_text">

						Office (210) 661-4000 <br />

						Fax: (210) 666-3875<br />

						Service Fax: (210) 661-7821

					</div>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="b_promo_text">

					<BR />

					Please contact us and let us know what we can do for you.<BR />

					Simply select the individual you wish to send a message to, fill out the pop-up form, and submit.<BR />

					Thank you<BR /><BR />

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="b_text_bold">

<?php 

	if ($scrub ==1)

		{

?>				

					Home Owner Contacts

<?php

		}

	else if ($scrub ==2)

		{

?>

					Home Builder Contacts

<?php

		}

	else if ($scrub ==3)

		{

?>

					Commercial Contacts

<?php

		}

?>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="contacts">

					<div class="contable_row">

						<div class="contablecol1">

							<div align="center" class="b_text_bold">

								Name

							</div>

						</div>

						<div class="contablecol2">

							<div align="center" class="b_text_bold">

								Job Title

							</div>

						</div>

					</div>

					<BR /><BR />

<?php 

	if ($scrub ==1)

		{

?>				

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=1" target="_blank">

								Barry Bankler

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=1" target="_blank">

								President

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<!--<a href="#">-->

							<a href="contact_us.php?c=3" target="_blank">

								Michelle Martinez

							</a>

						</div>

						<div class="contablecol2" align="center">

							<!--<a href="#">-->

							<a href="contact_us.php?c=3" target="_blank">

								Service & Warranty Manager

							</a>

						</div>

					</div>

				</div>

<?php

		}

	else if ($scrub ==2)

		{

?>

					<div class="contable_row">

						<div class="contablecol1">

							<!--<a href="#">-->

							<a href="contact_us.php?c=1" target="_blank">

								Barry Bankler

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=1" target="_blank">

								President

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=2" target="_blank">

								Bret Bartley

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=2" target="_blank">

								General Manager

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=11" target="_blank">

								Rusty Moore

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=11" target="_blank">

								Chief Construction Supervisor

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=10" target="_blank">

								Ruben Vasquez

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=10" target="_blank">

								Residential Construction Supervisor

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=9" target="_blank">

								Kevin Palmeri

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=9" target="_blank">

								Purchasing Manager

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=4" target="_blank">

								Doug Stokes

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=4" target="_blank">

								Estimator

							</a>

						</div>

					</div>

					<BR /><BR />

				</div>

<?php

		}

	else if ($scrub ==3)

		{

?>

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=1" target="_blank">

								Barry Bankler

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=1" target="_blank">

								President

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=2" target="_blank">

								Bret Bartley

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=2" target="_blank">

								General Manager

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=11" target="_blank">

								Rusty Moore

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=11" target="_blank">

								Chief Construction Supervisor

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=4" target="_blank">

								Doug Stokes

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=4" target="_blank">

								Estimator

							</a>

						</div>

					</div>

					<BR /><BR />

					<div class="contable_row">

						<div class="contablecol1">

							<a href="contact_us.php?c=9" target="_blank">

								Kevin Palmeri

							</a>

						</div>

						<div class="contablecol2" align="center">

							<a href="contact_us.php?c=9" target="_blank">

								Purchasing Manager

							</a>

						</div>

					</div>

					<BR /><BR />

				</div>

<?php

		}

?>

			<BR /><BR />

			<div class="hline">

				<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

			</div>

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

