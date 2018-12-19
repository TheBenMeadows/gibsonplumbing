<?php
	session_start();
	$MM_authorizedUsers = "";
	$MM_donotCheckaccess = "true";
	// *** Restrict Access To Page: Grant or deny access to this page
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) 
		{ 
			// For security, start by assuming the visitor is NOT authorized. 
			$isValid = False; 
			// When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
			// Therefore, we know that a user is NOT logged in if that Session variable is blank. 
			if (!empty($UserName)) 
				{
					// Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
					// Parse the strings into arrays. 
					$arrUsers = Explode(",", $strUsers); 
					$arrGroups = Explode(",", $strGroups); 
					if (in_array($UserName, $arrUsers)) 
						{ 
							$isValid = true; 
						} 
					// Or, you may restrict access to only certain users based on their username. 
					if (in_array($UserGroup, $arrGroups)) 
						{ 
							$isValid = true; 
						} 
					if (($strUsers == "") && true) 
						{ 
							$isValid = true; 
						} 
				} 
			return $isValid; 
		}
	$MM_restrictGoTo = "../_asrv_admin/asrv_login.php";
	if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) 
		{   
			$MM_qsChar = "?";
			$MM_referrer = $_SERVER['PHP_SELF'];
			if (strpos($MM_restrictGoTo, "?")) 
				$MM_qsChar = "&";
			if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
				$MM_referrer .= "?" . $QUERY_STRING;
			$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
			header("Location: ". $MM_restrictGoTo); 
			exit;
		}
?>
<?php
	/*Copyright March, 2004
	This php file is the exclusive property of Glyn Barrows.
	A right to use permission is granted to Daemon Systems
	for use in administering the Gibson Plumbing Web Site
		
*/	
	require_once('required_files.php');
?>
<?php
/*
	FOR TESTING
	
			foreach($_POST as $name=>$value)
				{
					echo ("P - ".$name." = ".$value)."<BR>";
				}
			foreach($_GET as $name=>$value)	
				{
					echo ("G - ".$name." = ".$value)."<BR>";
				}
 */		
	$Thedate = date("Y-m-d");
	$x = 0;
	$msg = "";
	$row_number = 0;
	foreach($_GET as $name=>$value )
		{	
			$msg .= ($name." = ".$value."<BR>");
			if ($name == "table_name")
				{
					$tablename = $value;
				}
			else if ($name == "action_name")
				{
					$action = $value;
				}
			else if ($name == "key_field")
				{
					$keyfield = $value;
				}
			else if ($name == "key_field_value")
				{
					$keyfieldvalue = $value;
				}
			else if (substr($name,0,8) == "quantity")
				{
					$file_inputs = $value;
				}	
		}
	foreach($_POST as $name=>$value )
		{	
			$msg .= ($name." = ".$value."<BR>");
			if ($name == "table_name")
				{
					$tablename = $value;
				}
			else if ($name == "action_name")
				{
					$action = $value;
				}
			else if ($name == "key_field")
				{
					$keyfield = $value;
				}
			else if ($name == "key_field_value")
				{
					$keyfieldvalue = $value;
				}
			else if (substr($name,0,8) == "quantity")
				{
					//if 
					$file_inputs = $value;
				}	
		}
	//echo($msg);
	
	mysql_select_db($main_db, $conn_main_db);
	$query_db_schema = "SELECT * FROM db_schema where table_name = '".$tablename."' AND field_form_label_order > 0 ORDER BY field_form_label_order asc";
	$db_schema = mysql_query($query_db_schema, $conn_main_db) or die(mysql_error());
	$row_db_schema = mysql_fetch_assoc($db_schema);
	$totalRows_db_schema = mysql_num_rows($db_schema);
	
	mysql_select_db($main_db, $conn_main_db);
	$query_rsTitle = "SELECT * FROM db_schema WHERE table_name = '".$tablename."' AND field_form_label_order = '0'";
	$rsTitle = mysql_query($query_rsTitle, $conn_main_db) or die(mysql_error());
	$row_rsTitle = mysql_fetch_assoc($rsTitle);
	$totalRows_rsTitle = mysql_num_rows($rsTitle);
/*
		echo ("total rows schema = ".$totalRows_db_schema."<BR><BR>");
*/
	mysql_select_db($main_db, $conn_main_db);
	$query_functional_areas = "SELECT * FROM $tablename";
	$functional_areas = mysql_query($query_functional_areas, $conn_main_db) or die(mysql_error());
	$row_functional_areas = mysql_fetch_assoc($functional_areas);
	$totalRows_functional_areas = mysql_num_rows($functional_areas);
	$halt = false;
	$site = "admin";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?php echo $action." ".$tablename;?></title>
		<script language="javascript" src = "../_javascript/_generic.js" type="text/JavaScript"></script>
		<script language="javascript" src = "../_javascript/_process_form.js" type="text/JavaScript"></script>
		<script language="javascript" src = "../_javascript/_form_actions.js" type="text/JavaScript"></script>		
	    <link href="../css/admin_site.css" rel="stylesheet" type="text/css">
	</head>
	<body onLoad="MM_preloadImages('../library/reset_form_button_f2.gif','../library/add_record_button_f2.gif','../library/update_button_f2.gif')">
			<div align="center">
				<table  border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="23%" rowspan="3" valign="top" class="style1">&nbsp;
						</td>
						<td width="38%" >&nbsp;						
						</td>
						<td width="39%" bgcolor="#F7F6E6" class="style_title">
<?php
	echo $action." ".$row_rsTitle['field_form_label'];
?>
						</td>
					</tr>
					<tr>
						<td colspan="2">						
							<form name="form1" method="post" action=""  enctype="multipart/form-data">
								<table>
<?php
	if (($action == 'change')||($action == 'approve'))
		{
			mysql_select_db($main_db, $conn_main_db);
			$query_main_data = "SELECT * FROM $tablename WHERE $keyfield = $keyfieldvalue";
			//echo("query = ".$query_main_data."<BR><BR>");
			$main_data = mysql_query($query_main_data, $conn_main_db) or die(mysql_error());
			$row_main_data = mysql_fetch_assoc($main_data);
			$totalRows_main_data = mysql_num_rows($main_data);
			//echo("totalRows_main_data = ".$totalRows_main_data."<BR><BR>");
			$group_counter = 1;
			$l=0;
			do 
				{ 
?>
									<tr>
										<td align="right" class="style3">										
<?php 
					echo ($row_db_schema['field_form_label']."....  "); 
?>
										</td>							
										<td width="350" align="left">
<?php
					if ($row_db_schema['field_type'] == "list")
						{
							$var1[$l] = $row_db_schema['xref_table']."_query";
							$var2[$l] = $row_db_schema['xref_table']."_rs";
							$var3[$l] = $row_db_schema['xref_table']."_row";
							$var4[$l] = $row_db_schema['xref_table']."_totalrows";
							if ($row_db_schema['field_list_code'] == 0)
								{
									//this is a list from a database table
									//Since this is a list, get the cross reference data from the database.
/*									
									mysql_select_db($main_db, $conn_main_db);
									$query_tch_list_data = "SELECT * FROM ".$row_db_schema['xref_table'];
									$tch_list_data = mysql_query($query_tch_list_data, $conn_main_db) or die(mysql_error());
									$row_tch_list_data = mysql_fetch_assoc($tch_list_data);
									$totalRows_tch_list_data = mysql_num_rows($tch_list_data);*//*
*/									
									mysql_select_db($main_db, $conn_main_db);
									$$var1[$l] = "SELECT * FROM ".$row_db_schema['xref_table'];
									$$var2[$l] = mysql_query($$var1[$l], $conn_main_db) or die(mysql_error());
									$$var3[$l] = mysql_fetch_assoc($$var2[$l]);
									$$var4[$l] = mysql_num_rows($$var2[$l]);
									$temp_2 = $$var3[$l];
?>
											<select name = "<?PHP echo($row_db_schema['field_name']); ?>" id="list_<?PHP echo($row_db_schema['field_name']); ?>" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','NONE','<?PHP echo($row_db_schema['field_type']); ?>',this.id, this.value);">
<?php
									//Reset the dataset
									mysql_data_seek($$var2[$l], 0);
									//get the first record
									/*
									$row_tch_list_data = mysql_fetch_assoc($tch_list_data);
									*/
									$$var3[$l] = mysql_fetch_assoc($$var2[$l]);
									do
										{
											//parse the field name entry because this could actually be more than one field which is intended to viewed as a single
											//entry.  A person's name is an example of this. The actual data needed is the table id number for the specific record.
											//For a person, a typical format for the data would be something like:
											//   ID    	FIRST_NAME    LAST_NAME 	MI.
											//	 7		  John			Doe			Q.
											//To refer to this record in its table, the seven is needed.  To visibly identify this record, possibly the full name
											//is needed...like:
											//		John Q. Doe.
											//So "John",  "Q", and  "Doe" should be concatenated and displayed as a single option of the select list/menu.
											$field_stuff = explode(",",$row_db_schema['xref_record_field']);
											$temp=$$var3[$l] ;
											$options_data_id = $temp['id_number'];
											if (sizeof($field_stuff) > 1)
												{
													for ($i = 0; $i<sizeof($field_stuff);$i++)
														{
															$options_data .= $temp[$field_stuff[$i]]." ";
														}
												}		
											else
												{
													$options_data = $temp[$field_stuff[0]];
												}
											if (!($selection) && (($row_main_data[$row_db_schema['field_name']] == "") || ($row_main_data[$row_db_schema['field_name']] == " ")))
												{
?>
												<option value="<?php echo ("NONE") ?>" selected><?php echo ("Please Select"); ?></option>
<?php
												$selection = true;
												}
											if($temp['id_number']==$row_main_data[$row_db_schema['field_name']])
												{
?>
												<option value="<?php echo $options_data_id; ?>" selected><?php echo $options_data; ?></option>
<?php
												}
											else
												{
?>
											  	<option value="<?php echo $options_data_id; ?>"><?php echo $options_data; ?></option>
<?php
												}
											$options_data = "";
										}
									while ($$var3[$l]  = mysql_fetch_assoc($$var2[$l] ));
?>
									</select>
<?php
							}
							
							else if ($row_db_schema['field_list_code'] == 1)
								{
?>
									<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="<?PHP echo("list_".$row_db_schema['field_name']); ?>" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ("NONE");?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
									foreach($states as $abbreviation =>$state_name) 
										{
	
											if($row_functional_areas['state'] == $state_name)
												{
?>	
													<option value="<?php echo $state_name; ?>" selected><?php echo $abbreviation; ?></option>
<?php
												}
											else
												{
?>	
													<option value="<?php echo $state_name; ?>"><?php echo $abbreviation; ?></option>
<?php
												}	
										}
?>
									</select>
<?php										
								}
							else if ($row_db_schema['field_list_code'] == 2)
								{
?>
									<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="<?PHP echo("list_".$row_db_schema['field_name']); ?>" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ("NONE");?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
									for ($i = 0;$i<sizeof($year);$i++)
										{
											if($row_main_data[$row_db_schema['field_name']] == $i)
												{
?>
										<option value="<?php echo $year[$i]; ?>" selected><?php echo $year[$i]; ?></option>
											
<?php
												}
											else
												{
?>
										<option value="<?php echo $year[$i]; ?>"><?php echo $year[$i]; ?></option>
<?php
												}	
										}
?>
									</select>
<?php							
								}
							else if ($row_db_schema['field_list_code'] == 3)
								{
?>
									<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="<?PHP echo("list_".$row_db_schema['field_name']); ?>" title="<?php echo($row_main_data[$row_db_schema['field_name']]) ?>" type="list"  onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ("NONE");?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
									for ($i = 0;$i<sizeof($counter1);$i++)
										{
											if($row_main_data[$row_db_schema['field_name']] == $counter1[$i])
												{
?>
										<option value="<?php echo $counter1[$i]; ?>" selected><?php echo $counter1[$i]; ?></option>
<?php
												}
											else
												{
?>
										<option value="<?php echo $counter1[$i]; ?>" ><?php echo $counter1[$i]; ?></option>
<?php
												}	
										}
?>
									</select>
									
<?php
								}							
						}
					else if ($row_db_schema['field_type'] == "text" || $row_db_schema['field_type'] == "numeric" || $row_db_schema['field_type'] == "phone" || $row_db_schema['field_type'] == "email" )
						{
?>
    								<input type="text" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>"  onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($row_main_data[$row_db_schema['field_name']]);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);"
										required="<?PHP
							if ($row_db_schema['required_flag']== "T")
								{
									echo('1');
								}
							else
								{
									echo ('0');
								} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
										  datatype = "<?php echo($row_db_schema['field_type']); ?>"
										value="<?php 
										echo ($row_main_data[$row_db_schema['field_name']]);
									?>">
<?php
						}
					else if ($row_db_schema['field_type'] == "picture")
						{
							
?>						
    						<br>
							<input type="file" name="<?php echo $row_db_schema['field_name']."_0"; ?>" id="<?php echo $row_db_schema['field_name']; ?>"  
										required="<?PHP
							if ($row_db_schema['required_flag']== "T")
								{
									echo('1');
								}
							else
								{
									echo ('0');
								} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
										  datatype = "<?php echo($row_db_schema['field_type']); ?>"
										  value="">
							</td>
						</tr>
						<tr >
							<td align="right">
								<br>
								Picture name in the database .... 
								<br><br>  
							</td>
							<td class="style8">
							<br>
<?PHP
							if (($row_main_data[$row_db_schema['field_name']] == "") || ($row_main_data[$row_db_schema['field_name']] == " "))
								{
									echo "No Picture Name in Database";
									$found = 1;
								}
							else
								{
									$file_name = $row_main_data[$row_db_schema['field_name']];
									$pic_cat = $row_main_data['category_id'];
									//echo("row_main_data['category'] = ".$row_main_data['category_id']."<BR><BR>");
									$unique_folder_name = get_unique_folder($row_db_schema,$totalRows_db_schema,$db_schema,$main_db,$conn_main_db,$tablename,$keyfieldvalue);
									mysql_data_seek($db_schema, $row_number);
									$row_db_schema = mysql_fetch_assoc($db_schema);
									//echo("unique_folder_name = ".$unique_folder_name."<BR><BR>");
									//echo("filename = ".$file_name."<BR>site = ".$site."<BR>tablename = ".$tablename."<BR>pic cat = ".$pic_cat."<br>");
									$found = locate_image($file_name,$site,$main_db,$conn_main_db,$tablename,$pic_cat,$unique_folder_name);
									//echo("found = ".$found."<BR><BR>");
									echo ($row_main_data[$row_db_schema['field_name']]."<BR>");
								}
							if (!($found))
								{
									echo("This picture cannot be located on the server.  It needs to be re-loaded.  Please BROWSE for it");
								}
						}	
					else if ($row_db_schema['field_type'] == "textarea")
						{
					    			?><textarea type="textarea" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" cols="50" rows="5" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','NONE<?php //echo ($row_main_data[$row_db_schema['field_name']]);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);"
										required="<?PHP 
										if ($row_db_schema['required_flag'] == "T")
											{
												echo('1');
											}
										else
											{
												echo ('0');
											}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1">
<?php 
										echo ($row_main_data[$row_db_schema['field_name']]);
									?></textarea>
<?php
						}
					else if ($row_db_schema['field_type'] == "password")
						{
?>
									<input type="password" id = "password" name="<?php echo $row_db_schema['field_name']; ?>" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($row_main_data[$row_db_schema['field_name']]);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);"
										value = "<?php								
									echo ($row_main_data[$row_db_schema['field_name']]);
									?>" required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1">
									</tr>
									<tr>
										<td align="right">
											retype password										</td>							
										<td width="350" align="left">
									<input type="password" id = "confirm" name="confirm" 
									required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1">
									
<?php
						}
					else if ($row_db_schema['field_type'] == "checkbox")
						{
?>
									<input type="checkbox" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" 
										value = "T" 
										required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
									<?php 
									if($row_main_data[$row_db_schema['field_name']] == 'T'||$row_main_data[$row_db_schema['field_name']] == 't')
										{
									?>
											checked
									<?php
										}
									?>	>
<?php
						}
					else if ($row_db_schema['field_type'] == "date")
						{
							$date_data = parse_date($row_main_data[$row_db_schema['field_name']]);
							$i =1;
?>
											Month <select name="<?PHP echo($row_db_schema['field_name']."_month"); ?>" id="month" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($date_data[1]/*$row_main_data[$row_db_schema['field_name']]*/);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
							foreach($months as $abbreviation =>$month_name) 
								{
									if ($i == $date_data[1])
										{
?>												
												<option value="<?php echo $month_name; ?>" selected><?php echo $abbreviation; ?></option>
<?php
										}
									else
										{
?>
												<option value="<?php echo $month_name; ?>"><?php echo $abbreviation; ?></option>
<?php
										}
									$i++;
								}
							$i=0;
?>
											</select>
											Day<select name = "<?PHP echo($row_db_schema['field_name']."_day"); ?>" id="day" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($date_data[2]/*$row_main_data[$row_db_schema['field_name']]*/);?>',this.id,this.value);">
<?php
							for($i=1; $i<32; $i++) 
								{						
									if ($i == $date_data[2])
										{
?>												
												<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
<?php
										}
									else
										{
?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
										}			
								}
?>
											</select>
											Year<select name = "<?PHP echo($row_db_schema['field_name']."_year"); ?>"  id="year" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($date_data[0])/*$row_main_data[$row_db_schema['field_name']]*/;?>',this.id,this.value);">
<?php
							for($i=2004; $i<2015; $i++) 
								{											
									if ($i == $date_data[0])
										{
?>												
												<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
<?php
										}
									else
										{	
?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
										}
								}
?>	
										</select>
<?php
						}
					else if ($row_db_schema['field_type'] == "feet")
						{
							$feet_data = parse_feet($row_main_data[$row_db_schema['field_name']]);
							$i =1;
							if ($row_main_data[$row_db_schema['field_name']] == "")
								{
									$feet_entry = 0;
								}
							else
								{
									$feet_entry = $row_main_data[$row_db_schema['field_name']];
								}
?>
									<input type="text" id = "feet" name="<?php echo $row_db_schema['field_name']."_feet_".$i; ?>" onChange="load_new_values(this.form,this.name,'<?php echo ($feet_entry);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);"
										value = "<?php								
									echo ($feet_data[0]);
									?>" required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"> - feet&nbsp;&nbsp;&nbsp;
									<select name = "<?PHP echo($row_db_schema['field_name']."_inches_".$i); ?>" id="inches" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($feet_data[1]);?>',this.id,this.value);">
<?php
							for($i=0; $i<12; $i++) 
								{						
									if ($i == $feet_data[1])
										{
?>												
												<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
<?php
										}
									else
										{
?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
										}			
								}
?>
											</select>- inches&nbsp;&nbsp;&nbsp;
<?php
						}
?>
									</td>
								</tr>
<?php
					$row_number++;
				} 
			while ($row_db_schema = mysql_fetch_assoc($db_schema)); 
?>
								<tr>
									<td>
									  <input name="UpdateThisRecordButton" id="update" type="image" src="../images/update_button.gif" width="162" height="22" border="0" alt="" onClick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','<?PHP echo($keyfield);?>',<?php echo($keyfieldvalue); ?>,'<?PHP echo($adminpage); ?>','admin');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('UpdateThisRecordButton','','../images/update_button_f2.gif',1);window.status='Update This Record.'; return true">
									</td>
									<td align="right">
										<input name="DeleteThisRecordButton" id="delete" type="image" src="../images/delete_button.gif" width="162" height="22" border="0" alt="" onClick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','<?PHP echo($keyfield);?>',<?php echo($keyfieldvalue); ?>,'<?PHP echo($adminpage); ?>','admin');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('DeleteThisRecordButton','','../images/delete_button_f2.gif',1);window.status='Delete This Record.'; return true">
									</td>
								</tr>
<?php
		}
	else 
		{
			$group_counter = 1;
			$l = 0;
			//Check to see if there is a list envolved.  If there is, then it must be populated before adding the particular type of record
			for ($i = 0 ;$i<$totalRows_db_schema;$i++)
				{
					if ($row_db_schema['field_type'] == 'list')
						{
/*						echo("here's a list<BR><BR>");*/
							$var1[$l] = $row_db_schema['xref_table']."_query";
							$var2[$l] = $row_db_schema['xref_table']."_rs";
							$var3[$l] = $row_db_schema['xref_table']."_row";
							$var4[$l] = $row_db_schema['xref_table']."_totalrows";
							//echo("639 - HERE and list code = ".$row_db_schema['field_list_code']."<BR><BR>");
				
							if ($row_db_schema['field_list_code'] == 0)
								{
/*									//$list_table = $row_db_schema['xref_table'];
									//Since this is a list, get the cross reference data from the database.
									mysql_select_db($main_db, $conn_main_db);
									$query_tch_list_data = "SELECT * FROM ".$row_db_schema['xref_table'];
									//echo ("tch_list_data SQL query statement = ".$query_tch_list_data."<BR><BR>");
									$tch_list_data = mysql_query($query_tch_list_data, $conn_main_db) or die(mysql_error());
									$row_tch_list_data = mysql_fetch_assoc($tch_list_data);
									$totalRows_tch_list_data = mysql_num_rows($tch_list_data);
*/
/*
									if ($totalRows_tch_list_data == 0)
										{
											$halt = true;
											$message = "Please enter categories before attempting to ".$action." ".$row_rsTitle['field_form_label'];
											break;
										}
*/
									mysql_select_db($main_db, $conn_main_db);
									$$var1[$l] = "SELECT * FROM ".$row_db_schema['xref_table'];
									$$var2[$l] = mysql_query($$var1[$l], $conn_main_db) or die(mysql_error());
									$$var3[$l] = mysql_fetch_assoc($$var2[$l]);
									$$var4[$l] = mysql_num_rows($$var2[$l]);
									if ($$var4[$l] == 0)
										{
											$halt = true;
											$message = "Please enter ".$row_db_schema['xref_table']." information before attempting to ".$action." this type of data.";
											break;
										}
									
								}
						}
					$l++;	
					$row_db_schema = mysql_fetch_assoc($db_schema);	
				}
//reset the recordset and variables
			if ($l >0)
				{
					$l = 0;
					mysql_data_seek($db_schema, 0);
					//get the first record
					$row_db_schema = mysql_fetch_assoc($db_schema);
				}
			if ($halt == false)
				{
					do 
						{ 
?>
								<tr>								
									<td align="right">
										<?php echo ($row_db_schema['field_form_label']."  ....  "); ?>									</td>
										<td width="350" align="left">
<?php						
							if ($row_db_schema['field_type'] == "text" || $row_db_schema['field_type'] == "numeric" || $row_db_schema['field_type'] == "phone" || $row_db_schema['field_type'] == "email")
								{

									if (isset($_GET['quantity']))
									//if (isset($_GET['action_name']))
										{
											//echo("IT IS SET");
											$count = $_GET['quantity'];
										}
									else if (isset($_POST['quantity']))
										{
											//echo("IT IS SET - 2");
											//echo("IT IS SET");
											$count = $_GET['quantity'];
										}
									else 
										{
											$count = 1;
										} 	
									$i = 0;
									if ($count >1)
										{
											do
												{
?>
									<input type="text" name="<?php echo $row_db_schema['field_name']."_".$i; ?>" id="<?php echo $row_db_schema['field_name']; ?>" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>" required="<?PHP
													if ($row_db_schema['required_flag']== "T")
														{
															echo('1');
														}
													else
														{
															echo ('0');
														} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
							 				value=""><br>						
<?PHP
													$i++;
												}
											while ($i < $count);
										}
									else
										{
?>
									<input type="text" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>" required="<?PHP
													if ($row_db_schema['required_flag']== "T")
														{
															echo('1');
														}
													else
														{
															echo ('0');
														} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
							 				value=""><br>						
<?PHP
										}
								}
							else if ($row_db_schema['field_type'] == "picture")
								{
									if (isset($_GET['quantity']))
									//if (isset($_GET['action_name']))
										{
											//echo("IT IS SET");
											$count = $_GET['quantity'];
										}
									else
										{
											//echo("IT IS SET - 2");
											$count = 1;
										}		
									$i = 0;
/**/
									do
										{
?>						
									<input type="file" name="<?php echo $row_db_schema['field_name']."_".$i; ?>" id="<?php echo $row_db_schema['field_name']; ?>" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>" required="<?PHP
											if ($row_db_schema['required_flag']== "T")
												{
													echo('1');
												}
											else
												{
													echo ('0');
												} 	
											?>" group_number = "<?php
												echo($group_counter);
												$group_counter++;
											?>" subgroup_number = "1"
												value=""><br>
<?PHP
											$i++;
										}
									while ($i < $count);
								}
							else if ($row_db_schema['field_type'] == "textarea")
								{
?>
									<textarea name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" cols="50" rows="5"
										required="<?PHP 
										if ($row_db_schema['required_flag'] == "T")
											{
												echo('1');
											}
										else
											{
												echo ('0');
											}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"></textarea>
<?php
								}
							else if ($row_db_schema['field_type'] == "checkbox")
								{
?>				
									<input type="checkbox" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" value = "T" required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1">
<?php
								}
							else if ($row_db_schema['field_type'] == "radio")
								{
?>				
									<input type="radio" name="<?php echo $row_db_schema['field_name']; ?>" id="<?php echo $row_db_schema['field_name']; ?>" >
<?php							
								}
							else if ($row_db_schema['field_type'] == "list")
								{
									if ($row_db_schema['field_list_code'] == 0)
										{
?>
									<select name = "<?PHP echo($row_db_schema['field_name']); ?>" id="list_<?PHP echo($row_db_schema['field_name']); ?>" type="list">
<?php
											//Reset the dataset
											//mysql_data_seek($tch_list_data, 0);
											mysql_data_seek($$var2[$l], 0);
											//get the first record
											//$row_tch_list_data = mysql_fetch_assoc($tch_list_data);
											$$var3[$l] = mysql_fetch_assoc($$var2[$l]);						
											$options_data = "";
											do
												{
													/**/
													//parse the field name entry because this could actually be more than one field which is intended to  be viewed as a single
													//entry.  A person's name is an example of this. The actual data needed is the table id number for the specific record.
													//For a person, a typical format for the data would be something like:
													//   ID    	FIRST_NAME    LAST_NAME 	MI.
													//	   7		  John					Doe				Q.
													//To refer to this record in its table, the seven is needed.  To visibly identify this record, possibly the full name
													//is needed...like:
													//		John Q. Doe.
													//So "John",  "Q", and  "Doe" should be concatenated and displayed as a single option of the select list/menu.
													$field_stuff = explode(",",$row_db_schema['xref_record_field']);
													//$options_data_id = $row_tch_list_data['id_number'];
													$temp = $$var3[$l];
													$options_data_id = $temp['id_number'];
													if (sizeof($field_stuff) > 1)
														{
															for ($i = 0; $i<sizeof($field_stuff);$i++)
																{
																	//$options_data .= $row_tch_list_data[$field_stuff[$i]]."  ";
																	$options_data .= $temp[$field_stuff[$i]]."  ";
																	//echo ("options_data  - ".$i." =  ".$options_data);
																}	
														}		
													else
														{
															$temp = $$var3[$l];
															//$options_data = $row_tch_list_data[$field_stuff[0]];
															$options_data = $temp[$field_stuff[0]];
														}
										      ?><option value = "<?php echo($options_data_id); ?>"><?php echo $options_data; ?></option>
<?php											
													$options_data = "";
												}
											while ($$var3[$l] = mysql_fetch_assoc($$var2[$l]));
?>
									  </select>
<?php								
										}
									else if	($row_db_schema['field_list_code'] == 1)
										{
?>
										<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="list_<?PHP echo($row_db_schema['field_name']); ?>" type="list">
<?php
											foreach($states as $abbreviation=>$state_name)
												{		
?>												
												<option value="<?php echo ($state_name); ?>"><?php echo $abbreviation; ?></option>
<?php
												}
?>
										  </select>
<?php										
										}	
									else if ($row_db_schema['field_list_code'] == 2)
										{
?>
									<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="<?PHP echo("list_".$row_db_schema['field_name']); ?>" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ("NONE");?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
											for ($i = 0;$i<sizeof($year);$i++)
												{
?>
										<option value="<?php echo $year[$i]; ?>"><?php echo $year[$i]; ?></option>
											
<?php
												}
?>
									</select>
									
<?php
										}							
									else if ($row_db_schema['field_list_code'] == 3)
										{
?>
									<select name="<?PHP echo($row_db_schema['field_name']); ?>" id="<?PHP echo("list_".$row_db_schema['field_name']); ?>" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ("NONE");?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);">
<?php
											for ($i = 0;$i<sizeof($counter1);$i++)
												{
?>
										<option value="<?php echo $counter1[$i]; ?>"><?php echo $counter1[$i]; ?></option>
<?php
												}
?>
									</select>
									
<?php
										}							
								}
							else if ($row_db_schema['field_type'] == "password")
								{
?>				
									<input type="password" name="<?php echo $row_db_schema['field_name']; ?>" id="password" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>"
										required="<?PHP
							if ($row_db_schema['required_flag']== "T")
								{
									echo('1');
								}
							else
								{
									echo ('0');
								} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
										value="">
									</tr>
									<tr>
										<td align="right">
											retype password										</td>							
										<td width="350" align="left">
									<input type="password" id = "confirm" name="confirm" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>"
									required="<?PHP 
									if ($row_db_schema['required_flag']== "T")
										{
											echo('1');
										}
									else
										{
											echo ('0');
										}	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1">
										
<?php
								}
					else if ($row_db_schema['field_type'] == "date")
						{
?>
											Month<select name = "<?PHP echo($row_db_schema['field_name']."_month"); ?>" id="month" type="list">
<?php
									foreach($months as $abbreviation =>$month_name) 
										{											
?>												
												<option value="<?php echo $month_name; ?>"><?php echo $abbreviation; ?></option>
<?php
										}
?>
												</select>
											Day<select name = "<?PHP echo($row_db_schema['field_name']."_day"); ?>" id="day" type="list" >
<?php
									for($i=1; $i<32; $i++) 
										{											
?>												
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												
<?php
										}
?>
											</select>
											Year<select name = "<?PHP echo($row_db_schema['field_name']."_year"); ?>" id="year" type="list">
<?php
									for($i=2004; $i<2015; $i++) 
										{											
?>												
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
										}
?>
											</select>											
<?php											
						}
					else if ($row_db_schema['field_type'] == "feet")
						{
							$feet_data = parse_feet($row_main_data[$row_db_schema['field_name']]);
							$i =1;
		
?>
									<input type="text" id = "feet" name="<?php echo $row_db_schema['field_name']."_feet_".$i; ?>" datatype="<?PHP echo ($row_db_schema['field_type'])  ?>" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($row_main_data[$row_db_schema['field_name']]);?>','<?php echo $row_db_schema['field_type']; ?>',this.id, this.value);"
										required="<?PHP
							if ($row_db_schema['required_flag']== "T")
								{
									echo('1');
								}
							else
								{
									echo ('0');
								} 	
									?>" group_number = "<?php
										echo($group_counter);
										$group_counter++;
									?>" subgroup_number = "1"
										value=""> - feet&nbsp;&nbsp;&nbsp;
									<select name = "<?PHP echo($row_db_schema['field_name']."_inches_".$i); ?>" id="inches" type="list" onChange="load_new_values(this.form,'<?php echo $row_db_schema['field_name']; ?>','<?php echo ($feet_data[2]/*$row_main_data[$row_db_schema['field_name']]*/);?>',this.id,this.value);">
<?php
							for($i=0; $i<12; $i++) 
								{						
?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
								}
?>
									</select>- inches&nbsp;&nbsp;&nbsp;
<?php
						}
?>
								</td>
							</tr>
<?php 
							$l++;
						} 
					while ($row_db_schema = mysql_fetch_assoc($db_schema)); 
?>
								<tr>
									<td>
										<input name="AddThisRecordButton" id = "add" type="image" src="../images/add_button.gif" width="162" height="22" border="0" alt="" onClick="process_form(this.form,this.id,'<?PHP echo($tablename);?>','No_field',0,'<?PHP echo($adminpage); ?>' ,'admin');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('AddThisRecordButton','','../images/add_button_f2.gif',1);window.status='Update This Record.'; return true">
									</td>
									<td align="right">
										<input name="ResetFormButton" type="image" src="../images/reset_button.gif" width="162" height="22" border="0" alt="" onClick="reset_form_fields();return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ResetFormButton','','../images/reset_button_f2.gif',1);window.status='Delete This Record.'; return true">
									</td>
								</tr>

<?php
				}
			else
				{
					$halt = false;
					echo $message;
				}								
		}	
?>
							</table>
						</form>
					</td>	
				</tr>
				<tr>
					<td bgcolor="#E4CBE3">&nbsp;
					</td>
					<td bgcolor="#E4CBE3">&nbsp;
					</td>
				</tr>
				<tr>
          			<td class="style8">
						<span class="add_db_links">
						<a href="../admin/gp_administration.php">
							Back to Admin						</a>						</span>					</td>
					<td>&nbsp;
						
					</td>
					<td>
					</td>
				</tr>
			</table>
    	</div>
	</body>
</html>
<?php
	mysql_free_result($db_schema);
	//mysql_free_result($functional_areas);
	mysql_free_result($rsTitle);
?>