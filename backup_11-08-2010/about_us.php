<?php	

	require_once('connections/conn_gibson.php'); 

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title>Gibson Plumbing AboutUs</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link href="css/gibson.css" rel="stylesheet" type="text/css" />

		<link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />

		<link href="css/about_us.css" rel="stylesheet" type="text/css" />

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

							</div>

						</div>

					</div>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

				<BR />

				<div class="body_row"> &nbsp;

					<A href="javascript:void window.open('get_directions.htm', 'directions', 'height=450px, width= 450px')">

						Get Directions

					</A>

				</div>

				<div class="hline">

					<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

				</div>

<!-- MAIN CONTENT STARTS HERE -->	

			

				<BR />

				<div class="textarea">

					<div align="center" class="b_promo_text">

						Technology and booming growth in San Antonio have brought about numerous changes to the<br /> structure of the company, but the values that built  the company have remained the same.<BR />

			            More than 50 years of success reflects our ongoing commitment to deliver quality service at a fair price.

					</div>

				</div>

				<div align="center">

				<div class="tab_row">

					&nbsp;

				</div>

					<div class="warrlink">

						<a href="#About Us">

								&nbsp;&nbsp;About Us&nbsp;&nbsp;

						</a>

					</div>

					<div class="warrlink">

						<a href="#spotlight">

								&nbsp;&nbsp;SA Builders Spotlight of the Month - November 2008&nbsp;&nbsp;	

						</a>

					</div>

					<div class="warrlink">

						<a href="#als">

								&nbsp;&nbsp;&nbsp;ALS&nbsp;&nbsp;&nbsp;

						</a>

					</div>

					<div class="warrlink">

						<a href="#green">

								&nbsp;&nbsp;Going Green - a WIN! WIN! WIN!&nbsp;&nbsp;	

						</a>

					</div>

					<div class="warrlink">

					</div>

						<div class="tab_row">&nbsp;</div>

							<div class="hline">

								<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

							</div>

						<div class="two_column">

							<a name="About Us">

								&nbsp;&nbsp;About Us&nbsp;&nbsp;

							</a>

							<div class="img_holder">

								<!--<img src="images/about_us/Gibson Plumbing 005_640x480.jpg" />-->

								<img src="images/Bankler_1.png" />

							</div>



							<div align="left">

									<?php echo "<BR>".$row_aboutus['header']." - ".$row_aboutus['text']; ?>

<?php

	$row_aboutus = mysql_fetch_assoc($aboutus);

?>

									<?php echo "<BR><BR>".$row_aboutus['header']." - ".$row_aboutus['text']; ?>

<?php

	$row_aboutus = mysql_fetch_assoc($aboutus);

?>

									<?php echo "<BR><BR>".$row_aboutus['header']." - ".$row_aboutus['text']."<BR><BR>"; ?>&nbsp;

							</div>

						</div>

						<div class="two_column">

Published in the PHCC Magazine

							<div class="two_column">

								<img src="images/about_us/bankler.jpg" width="775"/>

							</div>

							<div class="two_column">

								<h3 align="right">

									<a href="#top">Back To Top</a>

								 </h3>

							</div>

						</div>

							<div class="hline">

								<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

							</div>

						<div class="tab_row">&nbsp;</div>

						<div class="two_column">

							<a name="spotlight">

								&nbsp;&nbsp;SA Builders Spotlight of the Month - November 2008&nbsp;&nbsp;

							</a>

							<img src="images/about_us/BB_Nov_2008_Page_24.jpg" />

							<h3 align="right">

								<a href="#top">Back To Top</a>

							 </h3>

							<div class="hline">

								<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

							</div>

						</div>

						<div class="tab_row">&nbsp;</div>

						<div class="two_column">

							<a name="als">

								&nbsp;&nbsp;ALS&nbsp;&nbsp;

							</a>

							<div align="left">

								<div class="img_holder_als">

									<img src="images/about_us/als_logo.jpg" />

								</div>

										Gibson Plumbing Company put their best foot forward with friends and associates on October 18, 2008, joining in the Walk to “Defeat” ALS. 

Collectively we were able to raise $15,799.00, towards continued research 

for the cure of this heartbreaking disease. 

<BR /><BR />

We were inspired by the courage of one of our own that was diagnosed over a year ago, as having ALS.

We will continue to honor him as we work to bring awareness of this disease and the need for more research as there is currently no cure.

<BR /><BR />

Every 90 minutes a person in this country is diagnosed with ALS and every 90 minutes another person will lose their battle against this disease. ALS occurs throughout the world with no racial, ethnic or socioeconomic boundaries. 

<BR /><BR />

What is ALS?

<BR /><BR />

Often referred to as Lou Gehrig’s disease, amyotrophic lateral sclerosis (ALS) is a progressive, fatal neuromuscular disease that slowly robs the body of its ability to walk, speak, swallow and breathe. 

								<div class="img_holder_right_als">

									<img src="images/about_us/ALS Walk_adjusted.jpg" />

								</div>

<ol>

	<li>The life expectancy of an ALS patient averages two to five years from the time of diagnosis.</li>



	<li>Every 90 minutes someone in this country is diagnosed with ALS, and every 90 minutes another person will lose their battle against this disease. </li>



	<li>ALS can strike anyone. Presently there is no known cause of the disease. Someone you know or love may die from ALS unless a cure is found.</li>



	<li>Caring for a loved one with ALS costs on average of $200,000 each year.</li>

</ol>

<BR />

To learn more about The ALS Association & the difference you can make please visit

Alsasotx.org.

								</div>

							<h3 align="right">

								<a href="#top">Back To Top</a>

							 </h3>

							<div class="hline">

								<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

							</div>

						</div>

						<div class="tab_row">&nbsp;</div>

						<div class="two_column">

							<a name="green">

								&nbsp;&nbsp;Going Green - a WIN! WIN! WIN!&nbsp;&nbsp;

							</a>

							<div class="tab_row">&nbsp;</div>

							<div class="two_column">

								<div class="column_spacer">&nbsp;

								</div>

								<div class="two_column_right">

									<font size="4";>

										WIN! 

										<font color="#009900">

											San Antonio Saves Water

										</font>

										<BR />

										&nbsp;&nbsp;WIN! 

										<font color="#009900">

											You Save Money

										</font>

										<BR />

										&nbsp;&nbsp;&nbsp;&nbsp;WIN! 

										<font color="#009900">

											You preserve our Natural Resources

										</font>

										<BR /><BR/>

									</font>

								</div>

							</div>

							<div class="two_column">

								<div align="left">

									Gibson Plumbing Company is proud to be a part of the SAWS Water Conservation Program, where high consumption toilets are being replaced with high efficiency dual flush Caroma toilets. This program is so innovative it made news in New York City! 

									<BR /><BR />

									<img src="images/about_us/nytlogo.gif" />

									<BR />

									<font style="font-style:italic">

										August 3, 2008<BR />

										The toilets are made by an Australian manufacturer Caroma, and were installed as part of a project that also involved switching to low-flow showerheads. Since the change, water use at the hotel dropped by about a million gallons a month, according to Eddie Wilcut, conservation manager of the San Antonio Water System.  The drop was so substantial that “the hotel thought its water meter was broken”, he said. Mr. Wilcut attributed about 60% of that savings to the toilet.

									</font>

									<BR /><BR />

									The Hilton Palacio del Rio in San Antonio was one of the first to kick off the program by changing out 400 toilets to the new dual flush, in early 2007. There have been no reports of complaints or problems since the change out.

									<BR /><BR />

									In November 2008 Gibson Plumbing Company began changing out the 1,046 toilets at the “Marriott RiverCenter”  to the dual flush Caroma toilets.  Early reviews have shown that Hotel Customers are pleased with the toilets and the Staff are amazed at the drop in problematic calls regarding toilet issues.  The Rivercenter reports a savings of over 1 million gallons of water in the first month with the Caroma toilets.

									

									<BR /><BR />

								</div>

								<h3 align="right">

									<a href="#top">Back To Top</a>

								 </h3>

							</div>

						</div>

						<div class="hline">

							<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

						</div>

						<div class="hline">

							<img src="graphics/metalic_gradient.png" width="100%" height="5"/>

						</div>

						<div class="textarea">

							<div align="center" class="b_text_bold">

								Gibson Plumbing Company does unsurpassed quality plumbing work for  Residential Home contractors.

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









































