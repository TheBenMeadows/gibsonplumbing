<?php require_once('connections/conn_gibson.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gibson Plumbing Home Page<</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="holding/css/gibson.css" rel="stylesheet" type="text/css" />
		<link href="css/gibson.css" rel="stylesheet" type="text/css" />
		<link href="css/maintenance_page.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div align="center">
			<div class="page">
				<div class="top_row">
					<div class="logo_left">
						<img src="graphics/logo_1.png"/>						</div>
					<div class="holder1">
						<div class="title_1"></div>
						<div class="title_2">
							<img src="graphics/gibson_title.gif"/>						</div>
					</div>
					<div class="logo_right">
						<img src="graphics/logo_1.png"/>					</div>
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
				<div class="textarea1">
					<div class="b_text_bold_italic" align="center">Congratulations on the purchase 
						of your new home!
					</div>
				</div>
			  <a name="top" id="top"></a>
<?php
	mysql_select_db($database_conn_gibson, $conn_gibson);
	$query_categories = "SELECT * FROM ws_category ORDER BY sort_order ASC";
	$categories = mysql_query($query_categories, $conn_gibson) or die(mysql_error());
	$row_categories = mysql_fetch_assoc($categories);
	$totalRows_categories = mysql_num_rows($categories);

	
?>
				<div align="center">
					<a href="#<?php echo $row_categories['anchor_link']; ?>">
						<font color="#FF0000">
							<?php echo $row_categories['name']; ?>
						</font>
					</a>
					<br />
              	</div>
				<div align="center"><span class="b_text">Listed below 
                you&#8217;ll find the conditions under which Gibson Plumbing will 
                service and maintain our work in your new home.</span><br />
                <span class="b_text"><font color="#000000">This service warranty 
                is intended to be general in nature and to cover all of our existing 
                projects.</font><br />
                <font color="#000000">Not all of the items listed below may pertain 
                to your particular new home.</font></span><br />
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
			}while($row_textlines = mysql_fetch_assoc($textlines));
?>					
							</li>
						</ul>
					</span>
					<h3 align="right"><a href="#top">Back To Top</a> </h3>
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
			}while($row_textlines = mysql_fetch_assoc($textlines));
?>		
							</li>			
						</ol>
					</span>
					<h3 align="right"><a href="#top">Back To Top</a> </h3>
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
?>
					</span>
					<h3 align="right"><a href="#top">Back To Top</a> </h3>
<?php
		}
	}
?>				</div>
				<div class="textarea">
					<div align="center">
						<span class="b_text">Please complete 
          					a <a href="warranty_form.php">Warranty Request Form</a> <br />
          					A Gibson Plumbing service representative will contact you to schedule 
          					an appointment.
						</span><br />
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
mysql_free_result($categories);

mysql_free_result($textlines);
?>