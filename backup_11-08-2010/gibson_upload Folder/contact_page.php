<?php require_once('connections/conn_gibson.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Gibson Plumbing Contact</title>
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
					<div class="title_1"></div>
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
			</div>	
			<div class="hline">
				<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
			</div>
			<div class="contacttext1">
				<span class="b_promo_text">
							5511 Dietrich Road <br />
							San Antonio, Texas 78219
				</span>
			</div>
			<div class="contacttext2">
				<div class="b_promo_text">
					Office (210) 661-6741 <br />
					Fax: (210) 666-3875<br />
					Service Fax: (210) 661-7821
				</div>
			</div>
			<div class="contablecol1">
				<div align="center" class="b_text_bold">
					Name-Job Title
				</div>
			</div>
			<div class="contablecol2">
				<div align="center" class="b_text_bold">
					Ext.#
				</div>
			</div>
			<div class="contablecol3">
				<div align="center" class="b_text_bold">
					E-Mail
				</div>
			</div>
			<div class="contablecol4">
				<div align="center" class="b_text_bold">
					CELL Phone
				</div>
			</div>
<?php
mysql_select_db($database_conn_gibson, $conn_gibson);
$query_contact = "SELECT * FROM contact ORDER BY sort_order ASC";
$contact = mysql_query($query_contact, $conn_gibson) or die(mysql_error());
$row_contact = mysql_fetch_assoc($contact);
$totalRows_contact = mysql_num_rows($contact);
do
	{
?>
			<div class="b_text about_text">
				<div class="contablecol1">
					<?php echo $row_contact['name']; ?>
				</div>
				<div class="contablecol2" align="center">
					<?php echo $row_contact['ext']; ?>
				</div>
				<div class="contablecol3">
					<?php echo $row_contact['email']; ?>
				</div>
				<div class="contablecol4" align="left">
					<?php echo $row_contact['cell_phone']; ?>
				</div>
			</div>
<?php
		mysql_select_db($database_conn_gibson, $conn_gibson);
		$query_builders = "SELECT * FROM builders WHERE name_id = ".$row_contact['id_number'].";";
		$builders = mysql_query($query_builders, $conn_gibson) or die(mysql_error());
		$row_builders = mysql_fetch_assoc($builders);
		$totalRows_builders = mysql_num_rows($builders);
		if($totalRows_builders!=0)
			{
				do
					{
?>
			<div class="b_text about_text">
				<div class="contablecol1">
					<div class="buildercontact">
						<?php echo $row_builders['builder']; ?>
						</div>
				</div>
				<div class="contablecol2" align="center">
					&nbsp;
				</div>
				<div class="contablecol3">
					&nbsp;
				</div>
				<div class="contablecol4" align="left">
					&nbsp;
				</div>
			</div>					
<?php
					}
				while($row_builders = mysql_fetch_assoc($builders));
			}
?>
					
<?php
		if($row_contact = mysql_fetch_assoc($contact))
			{
?>
			<div class="conevenrow">
				<div class="b_text about_text">
					<div class="contablecol1">
						<?php echo $row_contact['name']; ?>
					</div>
					<div class="contablecol2" align="center">
						<?php echo $row_contact['ext']; ?>
					</div>
					<div class="contablecol3">
						<?php echo $row_contact['email']; ?>
					</div>
					<div class="contablecol4" align="left">
						<?php echo $row_contact['cell_phone']; ?>
					</div>
				</div>
<?php
				mysql_select_db($database_conn_gibson, $conn_gibson);
				$query_builders = "SELECT * FROM builders WHERE name_id = ".$row_contact['id_number'].";";
				$builders = mysql_query($query_builders, $conn_gibson) or die(mysql_error());
				$row_builders = mysql_fetch_assoc($builders);
				$totalRows_builders = mysql_num_rows($builders);
				if($totalRows_builders!=0)
					{
						do
							{
?>
				<div class="b_text about_text">
					<div class="contablecol1">
						<div class="buildercontact">
							<?php echo $row_builders['builder']; ?>
						</div>
					</div>
					<div class="contablecol2" align="center">
						&nbsp;
					</div>
					<div class="contablecol3">
						&nbsp;
					</div>
					<div class="contablecol4" align="left">
						&nbsp;
					</div>
				</div>					
<?php
							}
						while($row_builders = mysql_fetch_assoc($builders));
					}
			}
?>
			</div>
<?php
	}
while($row_contact=mysql_fetch_assoc($contact));
?>
		
		
			<div class="hline">
				<img src="graphics/metalic_gradient.png" width="100%" height="10"/>
			</div>
		</div>
	</div>	
</body>
</html>

<?php
mysql_free_result($contact);

mysql_free_result($builders);
?>

