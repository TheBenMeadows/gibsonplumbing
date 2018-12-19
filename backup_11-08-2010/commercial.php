<?php

	require_once('connections/conn_gibson.php');

 	mysql_select_db($database_conn_gibson, $conn_gibson);

	$query_Recordset1 = "SELECT * FROM maint_category ORDER BY sort_order ASC";

	$Recordset1 = mysql_query($query_Recordset1, $conn_gibson) or die(mysql_error());

	$row_Recordset1 = mysql_fetch_assoc($Recordset1);

	$totalRows_Recordset1 = mysql_num_rows($Recordset1);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing Home Page<</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

	    <link href="css/commercial_page.css" rel="stylesheet" type="text/css" />

		<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript">

		</script>

	</head>

	<body background="images/pipes-5.gif" >

		<a name="top" id="top"></a>

		<div  align="center">	

			<div class="page">

				<div class="top_row">

					<div class="logo_left">

						<img src="images/Bankler_4.png" height="190"/>

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

				<div class="body_row"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<A href="javascript:void window.open('get_directions.htm', 'directions', 'height=450px, width= 450px')">

						Get Directions

					</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<a href="#project_gallery">

							To Project Gallery -->

					</a>

				</div>

				<div class="body_row"> &nbsp;

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="body_row">

					<div class="image_holder">	

						<a href="http://www.axiomconstruction.com/">

							<img src="images/contractor_logos/axiom.jpg"/>						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.capitalcontractor.com">

							<img src="images/contractor_logos/capital.jpg"/>						</a>

					</div>

				</div>

				<div class="body_row">

					<div class="image_holder">	

						<a href="http://www.flournoyproperties.com/flournoy-development/	">

							<img src="images/contractor_logos/flournoy.jpg" />						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.gerloffinc.com/">

							<img src="images/contractor_logos/gerloff.jpg" />						</a>

					</div>

				</div>

				<div class="body_row">

					<div class="image_holder">	

						<a href="http://www.kjmcommercial.com/">

							<img src="images/contractor_logos/kjm_commercial.jpg"/>						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.calandrypartners.com/">

							<img src="images/contractor_logos/ca_landry.jpg" />						</a>

					</div>

				</div>

				<div class="body_row">

					<div class="image_holder">	

						<a href="http://www.http://metcontracting.com">

							<img src="images/contractor_logos/metropolitan.jpg" />						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.pecoconstruction.com/">

							<img src="images/contractor_logos/peco.jpg" />						</a>

					</div>

				</div>

				<div class="body_row">

					<div class="image_holder">	

						<a href="http://www.redhawkcontracting.com">

							<img src="images/contractor_logos/red_hawk.jpg" />						</a>

					</div>

					<div class="image_holder">	

						<a href="http://rhconstruction.net/">

							<img src="images/contractor_logos/rh.jpg"/>						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.struthoff.com/">

							<img src="images/contractor_logos/struthoff.jpg" />						</a>

					</div>

					<div class="image_holder">	

						<a href="http://www.workmancommercial.com/">

							<img src="images/contractor_logos/workman.jpg"/>						</a>

					</div>

				</div>

				<div class="body_row">

					<div class="image_holder_wide">	

						<a href="http://www.joeris.com/">

							<img src="images/contractor_logos/joeris1.jpg"/>

						</a>

					</div>

					<div class="image_holder">	

						<a href="#">

							<img src="images/contractor_logos/bartlett_cocke.jpg" />

						</a>

					</div>

					<div class="image_holder">	

						<BR />&nbsp;<BR />

						<a href="http://www.ftwoods.com">

							<img src="images/contractor_logos/ftwoods.jpg" />

						</a>

					</div>

				</div>

				<div class="body_row">

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="body_row">&nbsp;

				</div>

				<div class="body_row">

					<div class="section_titles_left">

						<span style="color:#CC0000">

							<div class="b_text_bold">

								<a name="project_gallery" id="project_gallery">

									Commercial Project Gallery

								</a>

							</div>	

						</span>

					</div>

					<div class="section_titles_right">

						<span style="color:#CC0000">

							<div class="b_text_bold">

								<a href="#top">Back To Top</a>

							</div>

						</span>

					</div>

				</div>

				<div class="body_row">&nbsp

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="body_row">

					<div class="project_image_holder">	

						<img src="images/projects/judson.jpg" />			

					</div>

					<div class="image_divider">&nbsp;</div>

					<div class="project_image_holder">	

						<img src="images/projects/judson_1.jpg" />			

					</div>

				</div>

				<div class="body_row">

					<div class="project_image_holder">

						<img src="images/projects/grease_interceptor.jpg" width="380" height="268" />

					</div>

					<div class="image_divider">&nbsp;</div>

					<div class="project_image_holder">

						<img src="images/projects/Havens.jpg" width="380" height="266" />

					</div>

				</div>

				<div class="body_row">

					<div class="project_image_holder">

					<img src="images/projects/blanton1.jpg" width="380" height="266" />

					</div>

					<div class="image_divider">&nbsp;</div>

					<div class="project_image_holder">

						<img src="images/projects/4oaks1.jpg" width="380" height="266" />

					</div>

				</div>

				<div class="body_row">

					<div class="project_image_holder">

						<img src="images/projects/rbrooks1.jpg" width="380" height="268" />

					</div>

					<div class="image_divider">&nbsp;</div>

					<div class="project_image_holder">

						<img src="images/projects/struthoff1.jpg" width="380" height="266" />

					</div>

				</div>

				<div class="body_row">

					<div class="project_image_holder">

						<img src="images/projects/best_buy.jpg" width="380" height="268" />

					</div>

					<div class="image_divider">&nbsp;</div>

					<div class="project_image_holder">

						<img src="images/projects/famous_footwear.jpg" width="380" height="266" />

					</div>

				</div>

				<img src="graphics/metalic_gradient.png" width="100%" height="5" />

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