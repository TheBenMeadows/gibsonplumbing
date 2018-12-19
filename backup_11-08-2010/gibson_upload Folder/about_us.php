<?php require_once('connections/conn_gibson.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gibson Plumbing AboutUs</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="css/gibson.css" rel="stylesheet" type="text/css" />
	    <link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div align="center">
			<div class="page">
				<div class="top_row">
					<div class="logo_left">
						<img src="graphics/logo_1.png"/>
					</div>
					<div class="holder1">
						<div class="title_1">
						</div>
						<div class="title_2">
							<img src="graphics/gibson_title.gif"/>
						</div>
					</div>
					<div class="logo_right">
						<img src="graphics/logo_1.png"/>
					</div>
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
				<div class="navbar">
					<a href="index.htm">Home</a> |
					<a href="maintenance.php">Maintenance</a> | 
					<a href="warranty.php">Warranty &amp; Service</a> | 
					<a href="about_us.php">About Us</a> | 
					<a href="contact_page.php">Contacts</a> | 
					<a href="career_opportunities.htm">Careers</a> | 
					<a href="builders.php">Builders Page </a> | 
					<a href="project_tracker.htm">Project Tracker</a>
					<h4 align="center">EMERGENCY? <br/>
          				<a href="emergency.htm">Click Here</a> 
					</h4>
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
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
<?php
mysql_select_db($database_conn_gibson, $conn_gibson);
$query_aboutus = "SELECT * FROM about_us ORDER BY sort_order ASC";
$aboutus = mysql_query($query_aboutus, $conn_gibson) or die(mysql_error());
$row_aboutus = mysql_fetch_assoc($aboutus);
$totalRows_aboutus = mysql_num_rows($aboutus);
?>
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
				<div class="textarea">
					<div align="center" class="b_text_bold">
						Gibson Plumbing Company does unsurpassed quality plumbing work for 
						Residential Home contractors.
					</div>
					<div align="center" class="b_text_bold_italic">
						Armadillo Homes, Centex Homes, Choice Homes, DR Horton, sLegacy Homes, 
						Medallion Homes,<br />McMillin Homes, Perry Homes, Ryland Homes, 
						Standard Pacific Homes, Whitestone Homes.
					</div>
				</div>
				<div class="hline">
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
			</div>
		</div>
	</body>
</html>				
<?php
mysql_free_result($aboutus);
?>

