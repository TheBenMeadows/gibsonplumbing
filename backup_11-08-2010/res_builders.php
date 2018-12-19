<?php require_once('connections/conn_gibson.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing AboutUs</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

		<link href="css/res_builder.css" rel="stylesheet" type="text/css" />

	</head>

	<body background="images/pipes-5.gif" >

		<a name="top" id="top"></a>

		<div  align="center">	

			<div class="page">

				<div class="top_row">

					<div class="logo_left">

						<img src="images/GibsonEmployeePhoto_1.jpg" height="150" width="600"/>

					</div>

					<div class="logo_right">

						<div class="logo">

							<div align="left">

								<BR />

								<div  class="logo_nav_row">

									<a href="index.php">Home</a>

								</div>

								<div  class="logo_nav_blank_row">&nbsp;</div>

								<div  class="logo_nav_row">

									<a href="contact_page.php" >Contacts</a>

								</div>

								<div  class="logo_nav_blank_row">&nbsp;</div>

								<div  class="logo_nav_row">

									<a href="about_us.php" >About Us</a> 

								</div>

<?php

 	//include_once("inc/nav_bar_vert_small.php");

?>

							</div>

						</div>

					</div>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="body_row"> &nbsp;

					<A href="javascript:void window.open('get_directions.htm', 'directions', 'height=450px, width= 450px')">

						Get Directions

					</A>

				</div>

				<div align="center" class="b_promo_text">

					<font size="4"><BR />Plumbing Stages

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

						<div align="center">

							<div class="sched_request">

									<br />&nbsp;

									<br />&nbsp;

									Scheduling Request Form &nbsp;&nbsp;&nbsp;

									<a href="builders_form.php">

										Click Here

								</a>

									<BR />

									<BR />

								<font color="#FF0000">

									Warranty Items are not to be entered on this form! 

								</font>

							</div>

						</div>

						<div align="center">

							<strong>

							</strong>

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



