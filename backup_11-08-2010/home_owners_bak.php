s<?php require_once('connections/conn_gibson.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing AboutUs</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

	    <link href="css/nav_bar_vert_small.css" rel="stylesheet" type="text/css" />

		<script language="javascript" src = "_javascript/mm_css_menu.js" type="text/JavaScript"></script>

		<script language="javascript" src = "_javascript/_generic.js" type="text/JavaScript"></script>

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

				<BR />

<?php

	mysql_select_db($database_conn_gibson, $conn_gibson);

	$query_categories = "SELECT * FROM ws_category ORDER BY sort_order ASC";

	$categories = mysql_query($query_categories, $conn_gibson) or die(mysql_error());

	$row_categories = mysql_fetch_assoc($categories);

	$totalRows_categories = mysql_num_rows($categories);

?>

					<div align="center">

						<a href="#<?php echo $row_categories['anchor_link']; ?>">

							<font color="#b51133">

								<?php echo $row_categories['name']; ?>

							</font>

						</a>

						<br />

					</div>

					<div align="center">

						<span class="b_text">

							Listed below you&#8217;ll find the conditions under which Gibson Plumbing will service and maintain our work.

						</span>

						<br />

						<span class="b_text">

							<font color="#000000">

								This service warranty is intended to be general in nature and to cover all of our existing projects.

							</font>

							<br />

							<font color="#000000">

								Not all of the items listed below may pertain to your particular project or job.

							</font>

						</span>

						<br />

					</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

<?php

	$row_categories = mysql_fetch_assoc($categories);

?>

					<div class="warrtoplink">

						<a href="#<?php echo $row_categories['anchor_link']; ?>"><?php echo $row_categories['name']; ?></a>

					</div>

<?php

	while($row_categories = mysql_fetch_assoc($categories))

	{

?>

					<div class="warrlink">

						<a href="#<?php echo $row_categories['anchor_link']; ?>"><?php echo $row_categories['name']; ?></a>				

					</div>                

<?php

	}

?>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

<?php	

	mysql_data_seek($categories,0);

	while($row_categories = mysql_fetch_assoc($categories))

	{

?>

					<div class="warrheader">

						<h3 class="b_text_bold">

							<a name="<?php echo $row_categories['anchor_link']; ?>" id="<?php echo $row_categories['anchor_link']; ?>"></a>

							<?php echo $row_categories['name']; ?>					

						</h3>

					</div>

					<div class="hline">

						<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

					</div>

					<div class="warrcomment">

						<span class="b_text">

<?php

		mysql_select_db($database_conn_gibson, $conn_gibson);

		$query_textlines = "SELECT * FROM ws_cat_info WHERE category_id = ".$row_categories['id_number']." ORDER BY sort_order ASC;";

		$textlines = mysql_query($query_textlines, $conn_gibson) or die(mysql_error());

		$row_textlines = mysql_fetch_assoc($textlines);

		$totalRows_textlines = mysql_num_rows($textlines);

		if($row_categories['text_type']=="Bullets")

			{

?>

					

							<ul>

<?php

				do

					{

?>

								<li><?php echo $row_textlines['text']; ?><br />

<?php

					}

				while($row_textlines = mysql_fetch_assoc($textlines));

?>					

								</li>

							</ul>

<?php

			}

		else if($row_categories['text_type']=="Numbered")

			{

?>

							<ol>

	<?php

				do

					{

	?>

								<li><?php echo	$row_textlines['text']; ?><br />

	<?php

					}

				while($row_textlines = mysql_fetch_assoc($textlines));

	?>		

								</li>			

							</ol>

<?php

		}

		else

		{

			do

			{

?>

							<p><?php echo	$row_textlines['text']; ?></p><br />

<?php

			}while($row_textlines = mysql_fetch_assoc($textlines));

		}

?>

						</span>

						<h3 align="right">

							<a href="#top">Back To Top</a>

						</h3>

					</div>

<?php

		}

?>

					<img src="graphics/metalic_gradient.png" width="100%" height="5px"/>

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

	if (isset($plumbingstages))

		mysql_free_result($plumbingstages);

?>



