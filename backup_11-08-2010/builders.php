<?php require_once('connections/conn_gibson.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing AboutUs</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

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

								Builders

						</div>

					</div>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

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

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="build_row">

					Gibson plumbing now offers extensive installation and service in both the Commercial and Residential arenas.

				</div>

				<div class="build_row">

					<a href="">Commercial Services</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">	Residential services</a>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div align="center" class="b_promo_text">

					<font size="4">Plumbing Stages

					</font>

				</div>

<?php

mysql_select_db($database_conn_gibson, $conn_gibson);

$query_plumbingstages = "SELECT * FROM plumbing_stages ORDER BY sort_order ASC";

$plumbingstages = mysql_query($query_plumbingstages, $conn_gibson) or die(mysql_error());

$row_plumbingstages = mysql_fetch_assoc($plumbingstages);

$totalRows_plumbingstages = mysql_num_rows($plumbingstages);

do

	{

?>

					<div class="build_row">

						<div class="build_stage">

							<?php echo $row_plumbingstages['stage_name']; ?>

						</div>

						<div class="build_stage_text">

							<?php echo $row_plumbingstages['description']; ?>

						</div>

					</div>

<?php

	}

	while ($row_plumbingstages = mysql_fetch_assoc($plumbingstages));

?>

					<div class="textarea">

						<div align="center"><strong><font color="#FF0000"><a href="builders_form.php">Scheduling 

						Request Form &nbsp;&nbsp;&nbsp;Click Here </a></font></strong> 

						</div>

						<div align="center"><strong><font color="#FF0000">Warranty 

						Items are not to be entered on this form! </font></strong>

						</div>

					</div>

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

<?php

mysql_free_result($plumbingstages);

?>



