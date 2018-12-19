<?php require_once('connections/conn_gibson.php'); ?>

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

		<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript">

		</script>

		

	  <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

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

						<br />

					</div>

        	<div id="TabbedPanels1" class="TabbedPanels">

          	<ul class="TabbedPanelsTabGroup">

<?php

	mysql_select_db($database_conn_gibson, $conn_gibson);

	$query_categories = "SELECT * FROM ws_category ORDER BY sort_order ASC";

	$categories = mysql_query($query_categories, $conn_gibson) or die(mysql_error());

	$row_categories = mysql_fetch_assoc($categories);

	$totalRows_categories = mysql_num_rows($categories);

	$x = 0;

	for ($i=0;$i<$totalRows_categories;$i++)

		{

			$cat_array[$i][0] = $row_categories["id_number"];

			$cat_array[$i][1] = $row_categories["name"];

			$cat_array[$i][2] = $row_categories["text_type"];

?>

              <li class="TabbedPanelsTab" tabindex="0">

                <?php echo $row_categories['name']; ?>

              </li>

<?php

			$row_categories = mysql_fetch_assoc($categories);

		}

?>

            </ul>

<!--						<div class="tab_row"></div>-->

            <div class="TabbedPanelsContentGroup">

<?php 

	for ($i=0; $i<sizeof($cat_array);$i++)

		{

			mysql_select_db($database_conn_gibson, $conn_gibson);

			$query_textlines = "SELECT * FROM ws_cat_info WHERE category_id = ".$cat_array[$i][0]." ORDER BY sort_order ASC;";

			$textlines = mysql_query($query_textlines, $conn_gibson) or die(mysql_error());

			$row_textlines = mysql_fetch_assoc($textlines);

			$totalRows_textlines = mysql_num_rows($textlines);

?>

              <div class="TabbedPanelsContent">

<?php

			if($cat_array[$i][2]=="Bullets")

				{

?>

                <ul>

<?php

					do

						{

?>

                  <li><?php echo $row_textlines['text']; ?><br /><br />

<?php

						}

					while($row_textlines = mysql_fetch_assoc($textlines));

?>					

                  </li>

                </ul>

<?php

				}

			else if($cat_array[$i][2]=="Numbered")

				{

?>

                <ol>

<?php

					do

						{

?>

                  <li><?php echo	$row_textlines['text']; ?><br /><br />

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

                <p><?php echo	$row_textlines['text']; ?></p><br /><br />

<?php

						}

					while($row_textlines = mysql_fetch_assoc($textlines));

				}

?>

            </div>

<?php

		}

?>

          </div>

        </div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

			</div>

		</div>

	  <script type="text/javascript">

<!--

var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

//-->

    </script>

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









































