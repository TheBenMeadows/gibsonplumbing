<?php require_once('connections/conn_gibson.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing AboutUs</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

	    <link href="css/about_us.css" rel="stylesheet" type="text/css" />

		<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>

		<script language="javascript" type="text/javascript" src="SpryAssets/SpryDOMUtils.js"></script>

		<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />

</head>

	<body background="images/pipes-5.gif" >

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

									<a href="about_us.php" >About Us</a> 

								</div>

								<div  class="logo_nav_blank_row">&nbsp;</div>

								<div  class="logo_nav_row">

									<a href="career_opportunities.htm" >Careers</a> 

								</div>

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

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<div class="textarea">

					<div align="center" class="b_promo_text">

							More than 50 years of success reflects our ongoing commitment to 

							deliver quality service at a fair price.

					</div>

					<div align="center" class="b_promo_text">

						Technology and booming growth in San Antonio have brought about numerous

						changes to the<br /> structure of the company, but the values that built 

						the company have remained the same.

					</div>

				</div>

        <BR />

<?php

mysql_select_db($database_conn_gibson, $conn_gibson);

$query_aboutus = "SELECT * FROM about_us ORDER BY sort_order ASC";

$aboutus = mysql_query($query_aboutus, $conn_gibson) or die(mysql_error());

$row_aboutus = mysql_fetch_assoc($aboutus);

$totalRows_aboutus = mysql_num_rows($aboutus);



$query_builders = "SELECT * FROM builders ORDER BY builder ASC";

$builders = mysql_query($query_builders, $conn_gibson) or die(mysql_error());

$row_builders = mysql_fetch_assoc($builders);

$totalRows_builders = mysql_num_rows($builders);

?>

<div id="CollapsiblePanelGroup1" class="CollapsiblePanelGroup">

  <div id="CollapsiblePanel1" class="CollapsiblePanel">

    <div class="CollapsiblePanelTab" tabindex="0" onclick="cp1.closeAllPanels();">About Us</div>

    <div class="CollapsiblePanelContent">

        <div class="img_holder">

        <img src="images/about_us/Gibson Plumbing 005_640x480.jpg" />

      </div>

      <div align="left">

        <?php echo "<BR>".$row_aboutus['header']." - ".$row_aboutus['text']; ?>

      </div>

<!--

			<div class="text">

			</div>

-->

<?php

		$row_aboutus = mysql_fetch_assoc($aboutus);

?>

      <div align="left">

        <?php echo "<BR>".$row_aboutus['header']." - ".$row_aboutus['text']; ?>

        </div>

<?php

		$row_aboutus = mysql_fetch_assoc($aboutus);

?>

      <div align="left">

        <?php echo "<BR>".$row_aboutus['header']." - ".$row_aboutus['text']."<BR><BR>"; ?>

      </div>

    </div>

  </div>

  <div id="CollapsiblePanel2" class="CollapsiblePanel">

    <div class="CollapsiblePanelTab" tabindex="0" onclick="cp1.closeAllPanels();">SA Builders Spotlight of the Month - November 2008</div>

    <div class="CollapsiblePanelContent">&nbsp;<BR />

        The <font style="font-weight:bold">Greater San Antonio Builders Association</font> has honored Gibson Plumbing <BR>in their Spotlight of the Month 

        Section of their "The Builder Brief" magazine.  <BR /><BR />

    	<div align="left">

        

        <font style="font-style:italic">The Greater San Antonio Builders Association and the Greater San Antonio 

        Education Foundation fould like to loudly thank <font style="font-weight:bold">Barry Bankler</font> and 

        the <font style="font-weight:bold">Gibson Plumbing</font> family for thier tireless and 

        unselfish work on the 2008 Charity Home.  Their no-questions-asked commitment to this project is 

        reflective of their absolute commitment to their industry and to their Association.  Gibson Plumbing: 

        the Association, Foundation, and future scholarship holders thank you!<BR />&nbsp;</font>

      </div>

    </div>

  </div>

  <div id="CollapsiblePanel3" class="CollapsiblePanel">

    <div class="CollapsiblePanelTab" tabindex="0" onclick="cp1.closeAllPanels();">ALS</div>

    <div class="CollapsiblePanelContent">

      <div class="two_column">

        <div class="two_column_left">

          <div class="img_holder">

            <img src="images/about_us/ALS Walk_adjusted.jpg" />

        </div>

        </div>

        <div class="two_column_right">

          This is information about the ALS event

        </div>

       </div>

    </div>

  </div>

  <div id="CollapsiblePanel4" class="CollapsiblePanel">

    <div class="CollapsiblePanelTab" tabindex="0" onclick="cp1.closeAllPanels();">

      Going Green&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;a&nbsp;&nbsp;WIN! WIN! WIN!

    </div>

    <div class="CollapsiblePanelContent">

    	<div class="two_column">

        <div class="column_spacer">&nbsp;

        </div>

        <div class="two_column_right">

          <font size="4";>WIN! <font color="#009900">San Antonio Saves Water</font><BR />

          &nbsp;&nbsp;WIN! <font color="#009900">You Save Money</font><BR />

          &nbsp;&nbsp;&nbsp;&nbsp;WIN! <font color="#009900">You preserve our Natural Resources</font><BR /><BR>

          </font>

        </div>

			</div>

      <div align="left">

        San Antonio Water Systems Conservation Program.<BR />

        The program, offered by SAWS and supported by Gibson Plumbing Company is so innovative it made news in New York City.<BR /><BR />

        <img src="images/about_us/nytlogo.jpg" /><BR />

        <font style="font-style:italic">

        August 3, 2008<BR />....toilets are made by an Australian manufacturer, Caroma, and were installed as part of 

        a project that also involved switching to low flow showerheads.  Since the change, water use at the hotel 

        dropped by about a million gallons a month, according to Eddie Wilcut, conservation manager of the San Antonio 

        Water System.  The drop was so substantial that "the hotel thought its water meter was broken",  he said.  

        Mr. Wilcut attributed about 60% of that savings to the toilet......</font><BR /><BR /> In November of 2008,

        Gibson Plumbing began changing out 1,056 toilets at the Marriot River Center and, once completed, will begin 

        changing out 500 toilets at the Marriot River Walk.<BR /><BR /> The Hilton Palacio del Rio in San Antonio was 

        one of the first to kick off the program by changing out 400 toilets to the new dual flush in early 2007.  

        There have been no reports of complaints or problems since the change out.<BR /><BR />Now is the time for a 

        <font color="#009900">GREEN</font> project!!<BR />Contact Delta Vaughn, (210) 661-4000 to set up a free audit.<BR />Do it today!!!!

      </div>

    </div>

  </div>

</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

<!--



				<div class="container">

					<div class="usholder">

						<div class="uscol1">

							<div class="usheader">

								<div class="b_text_bold"><?php echo $row_aboutus['header']; ?>

								</div>

							</div>

							<div class="usheader">

								<div class="b_text"><?php echo $row_aboutus['text']; ?>

								</div>

							</div>

						</div>

						<div class="vline">

						</div>

	<?php

		$row_aboutus = mysql_fetch_assoc($aboutus);

	?>

						<div class="uscol2">

							<div class="usheader">

								<div class="b_text_bold"><?php echo $row_aboutus['header']; ?>

								</div>

							</div>

							<div class="usheader">

								<div class="b_text"><?php echo $row_aboutus['text']; ?>

								</div>

							</div>

						</div>

						<div class="vline">

						</div>

	<?php

		$row_aboutus = mysql_fetch_assoc($aboutus);

	?>

						<div class="uscol3">

							<div class="usheader">

								<div class="b_text_bold"><?php echo $row_aboutus['header']; ?>

								</div>

							</div>

							<div class="usheader">

								<div class="b_text"><?php echo $row_aboutus['text']; ?>

								</div>

							</div>

						</div>

					</div>

				</div>

-->

				<div class="textarea">

					<div align="center" class="b_text_bold">

						Gibson Plumbing Company does unsurpassed quality plumbing work for 

						Residential Home contractors.

					</div>

					<div class="builders">

<?PHP

	do

		{

			echo($row_builders['builder'].", ");

		}

	while ($row_builders = mysql_fetch_assoc($builders));



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

		

			var cp1 = new Spry.Widget.CollapsiblePanelGroup("CollapsiblePanelGroup1",{contentIsOpen:false});

	

/*		

			var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");

			var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");

			var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel3");

			var CollapsiblePanel4 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel4");

				



			var coll_panel_state = new Array(4);

			coll_panel_state["CollapsiblePanel1"] = new Array(2);

			coll_panel_state["CollapsiblePanel1"][0] = CollapsiblePanel1;

			coll_panel_state["CollapsiblePanel1"][1] = "C";

			coll_panel_state["CollapsiblePanel2"] = new Array();

			coll_panel_state["CollapsiblePanel2"][0] = CollapsiblePanel2;

			coll_panel_state["CollapsiblePanel2"][1] = "C";

			coll_panel_state["CollapsiblePanel3"] = new Array();

			coll_panel_state["CollapsiblePanel3"][0] = CollapsiblePanel3;

			coll_panel_state["CollapsiblePanel3"][1] = "C";

			coll_panel_state["CollapsiblePanel4"] = new Array();

			coll_panel_state["CollapsiblePanel4"][0] = CollapsiblePanel4;

			coll_panel_state["CollapsiblePanel4"][1] = "C";



									window[CollapsiblePanel1.id] = new Spry.Widget.CollapsiblePanel(n, { contentIsOpen: false, enableAnimation: false }); 

									window[CollapsiblePanel2.id] = new Spry.Widget.CollapsiblePanel(n, { contentIsOpen: false, enableAnimation: false }); 

									window[CollapsiblePanel3.id] = new Spry.Widget.CollapsiblePanel(n, { contentIsOpen: false, enableAnimation: false }); 

									window[CollapsiblePanel4.id] = new Spry.Widget.CollapsiblePanel(n, { contentIsOpen: false, enableAnimation: false }); 

*/	







/**/

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

mysql_free_result($aboutus);

?>



