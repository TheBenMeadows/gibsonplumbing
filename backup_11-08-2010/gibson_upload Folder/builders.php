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
				<div class="container">
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
					<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
mysql_free_result($plumbingstages);
?>

