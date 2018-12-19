<?php require_once('connections/conn_gibson.php'); ?>

<?php

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

								Maintenance

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

				<div class="textarea1">

					<div class="b_text_bold_italic" align="center"></div>

					<div class="b_promo_text">

							<font color="#000000">Proper care and Maintenence are important to 

								you and the life of your new products.

							</font>

							<br />

                			<br />

					</div>

					<div class="b_text_bold">

						<div class="b_text" align="center">We strongly recommend that you visit

							the websites provided for proper care and tips<br />

                			to keep your new home features working and looking their best.

						</div> 

              		</div>

				</div>

<?php

do

	{

		mysql_select_db($database_conn_gibson, $conn_gibson);

		$query_vendor = "SELECT * FROM maint_vendor WHERE category_id = ".$row_Recordset1['id_number']." ORDER BY sort_order ASC;";

		$vendor = mysql_query($query_vendor, $conn_gibson) or die(mysql_error());

		$row_vendor = mysql_fetch_assoc($vendor);

		$totalRows_vendor = mysql_num_rows($vendor);

		if (isset($row_vendor['id_number']))

			{

?>

				<div class="category">

					<div class="b_promo_text">

						<div class="b_text_bold_italic">

							<font color="#000000"><?php echo $row_Recordset1['category_name']; ?>

							</font>

						</div>

					</div>

				</div>

<?php

				do

					{

?>				

				<div class="vendor">

					<div class="comments">

<?php

						mysql_select_db($database_conn_gibson, $conn_gibson);

						$query_vendortext = "SELECT * FROM maint_ven_text WHERE vendor_id = ".$row_vendor['id_number']." ORDER BY sort_order ASC;";

						$vendortext = mysql_query($query_vendortext, $conn_gibson) or die(mysql_error());

						$row_vendortext = mysql_fetch_assoc($vendortext);

						$totalRows_vendortext = mysql_num_rows($vendortext);

						do

							{

?>

						<div class="comment">

	                        <span class="b_text"><?php echo $row_vendortext['text_line']; ?></span>

                        </div>

<?php

							}

						while($row_vendortext = mysql_fetch_assoc($vendortext));

?>

						<div class="comment">

							<a href="http://<?php echo $row_vendor['link']; ?>" target="_blank">

								<?php echo $row_vendor['link']; ?>

                			</a>

						</div>

					</div>

					<div class="image">

						<a href="http://<?php echo $row_vendor['link']; ?>" target="_blank">

							<img src="<?php echo ("vendor_images/".$row_vendor['image']); ?>" border="0"/>

						</a>

					</div>

				</div>

<?php

					}

				while ($row_vendor = mysql_fetch_assoc($vendor));

			}

	}

while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));

?>		

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

mysql_free_result($Recordset1);



mysql_free_result($vendor);



mysql_free_result($vendortext);

?>



