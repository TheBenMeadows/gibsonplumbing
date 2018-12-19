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

	$MM_restrictGoTo = "../_admin/gp_login.php";

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

/*Copyright March, 2004echo "Starting";

This php file is the exclusive property of Glyn Barrows.

A right to use permission is granted to 3CreatHearts

for use in administering the 3CreativeHearts Web Site

*/

		require_once('required_files.php');

?>

<?php

	$Thedate = Date("Y-m-d");

	$x = 0;

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

	foreach($_GET as $name=>$value )

		{			

			if ($name == "table_name")

				{

					$tablename = $value;

				}

			else if ($name == "action_name")

				{

					$action = $value;

				}

		}

	foreach($_POST as $name=>$value )

		{			

			if ($name == "table_name")

				{

					$tablename = $value;

				}

			else if ($name == "action_name")

				{

					$action = $value;

				}

		}

	mysql_select_db($main_db, $conn_main_db);

	$query_rsTitle = "SELECT * FROM db_schema WHERE table_name = '".$tablename."' AND field_form_label_order = 0;";

	$rsTitle = mysql_query($query_rsTitle, $conn_main_db) or die(mysql_error());

	$row_rsTitle = mysql_fetch_assoc($rsTitle);

	$totalRows_rsTitle = mysql_num_rows($rsTitle);

	

	$query_db_schema = "SELECT * FROM db_schema WHERE table_name = '".$tablename."' AND field_form_label_order > 0;"; 

	//AND (searchable_field_1_flag = 'T' OR searchable_field_2_flag = 'T') ";

	$db_schema = mysql_query($query_db_schema, $conn_main_db) or die(mysql_error());

	$row_db_schema = mysql_fetch_assoc($db_schema);

	$totalRows_db_schema = mysql_num_rows($db_schema);

	//echo("query1 = ".$query_db_schema."<BR><BR>");

	//echo("query1 num rows = ".$totalRows_db_schema."<BR><BR>");

	//echo("query3 = ".$query_rsTitle."<BR><BR>");

	//echo("query3 num rows = ".$totalRows_db_schema."<BR><BR>");

	$col_1_field_name = " ";

	$col_2_field_name = " ";

	for ($i=0; $i<$totalRows_db_schema; $i++)

		{

			//echo("field_name = ".$row_db_schema['field_name']."<BR><BR>"); =='T'

			//echo("Searchable field 1 flag = ".$row_db_schema['searchable_field_1_flag']."<BR><BR>");

			if ($row_db_schema['searchable_field_1_flag'] == "T")

				{

					if (!($row_db_schema['xref_record_field'] == "") && !($row_db_schema['xref_record_field'] == " "))

						{

							$col_1_field_label = $row_db_schema['xref_record_field'];

						}

					else

						{

							$col_1_field_label = $row_db_schema['field_form_label'];

						}	

					$col_1_field_name = $row_db_schema['field_name'];

					//echo("col_1_field_name = ".$col_1_field_name."<BR><BR>");

					if ($row_db_schema['field_type'] == "list")

						{

							$sub_select_1 = "SELECT * FROM ".$row_db_schema['xref_table']." ORDER BY id_number;";

						}

				}

			if ($row_db_schema['searchable_field_2_flag'] == "T")

				{

					$col_2_field_label = $row_db_schema['field_form_label'];

					if (!($row_db_schema['xref_record_field'] == "") && !($row_db_schema['xref_record_field'] == " "))

						{

							$col_2_field_label = $row_db_schema['xref_record_field'];

						}

					else

						{

							$col_2_field_label = $row_db_schema['field_form_label'];

						}	

					$col_2_field_name = $row_db_schema['field_name'];

					//echo("col_2_field_name = ".$col_2_field_name."<BR><BR>");

					if ($row_db_schema['field_type'] == "list")

						{

							$sub_select_2 = "SELECT * FROM ".$row_db_schema['xref_table']." ORDER BY id_number;";

						}	

				}

			$row_db_schema = mysql_fetch_assoc($db_schema);

		}

		

	$keyfield = 'id_number';

	//echo("HERE<BR><BR>");

	if ($tablename == "guest_comments")

		{

			$query_functional_areas = "SELECT * FROM $tablename WHERE approved_status = 'F' OR approved_status = 'f';";

			$functional_areas = mysql_query($query_functional_areas, $conn_main_db) or die(mysql_error());

			$row_functional_areas = mysql_fetch_assoc($functional_areas);

			$totalRows_functional_areas = mysql_num_rows($functional_areas);

			//echo("query2 = ".$query_functional_areas."<BR><BR>");

			//echo("query2 num rows = ".$totalRows_db_schema."<BR><BR>");

		}

	else

		{

			$query_functional_areas = "SELECT * FROM $tablename ORDER BY ".$col_1_field_name.";";

			//echo("query2 = ".$query_functional_areas."<BR><BR>");

			$functional_areas = mysql_query($query_functional_areas, $conn_main_db) or die(mysql_error());

			$row_functional_areas = mysql_fetch_assoc($functional_areas);

			$totalRows_functional_areas = mysql_num_rows($functional_areas);

			//echo("query2 num rows = ".$totalRows_functional_areas."<BR><BR>");

		}

	if (isset($sub_select_1))

		{

			$col1_schema = mysql_query($sub_select_1, $conn_main_db) or die(mysql_error());

			$row_col1_schema = mysql_fetch_assoc($col1_schema);

			$totalRows_col1_schema = mysql_num_rows($col1_schema);

		}

	if (isset($sub_select_2))

		{

			$col2_schema = mysql_query($sub_select_2, $conn_main_db) or die(mysql_error());

			$row_col2_schema = mysql_fetch_assoc($col2_schema);

			$totalRows_col2_schema = mysql_num_rows($col2_schema);

		}

		

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		<title>

<?php

	echo $action." ".$tablename;

?>			

		</title>

		<script language="JavaScript" src = "../_javascript/_form_actions.js" type="text/JavaScript"></script>		

		<script language="JavaScript" src = "../_javascript/_generic.js" type="text/JavaScript"></script>		

		<script language="JavaScript" src = "../_javascript/_process_forms.js" type="text/JavaScript"></script>			

	    <link href="../css/admin_site.css" rel="stylesheet" type="text/css">

	</head>

	<body>

		<table width="100%"  border="0">

			<tr>

				<td width="23%" rowspan="3" valign="top" class="style1">&nbsp;

				</td>

				<td width="38%" bgcolor="#F7f6e6">&nbsp;

			  </td>

<?php

	if ($totalRows_functional_areas == 0)

		{

?>

				<td class="style2">

					There are no records in the database to be updated.

					<br>

					Please click on Back below to add records.

				</td>

<?php	

		}

	else

		{	

?>

				<td width="39%" bgcolor="#F7F6E6" class="style_title">

<?php

			echo "Please select one <BR>".$row_rsTitle['field_form_label'];

?>

				</td>

			</tr>

			<tr>

				<td>&nbsp;

					

			  </td>

				<td>&nbsp;

					

			  </td>

			</tr>

			<tr>

				<td colspan="2">

					<table>

<?php

			if ($tablename 	== "orders")

				{

					if ($totalRows_functional_areas == 0)

						{

							echo ("No Orders to be reviewed at this time");

						}

					else

						{

							$order_number = array();

							do 

								{

									$j=0;

									$match = false;

									for ($i=0;$i<$totalRows_functional_areas;$i++)

										{

											if (sizeof($order_number) == 0)

												{

													$order_number[0] = $row_functional_areas['order_number'];

												}

											else

												{

													for ($j=0;$j<sizeof($order_number);$j++)

														{

															if ($order_number[$j]==$row_functional_areas['order_number'])

																{

																	$match = true;

																	break;

																}

														}

													if ($match == false)

														{

															$order_number[sizeof($order_number)] = $row_functional_areas['order_number'];

														}	

													else

														{

															$match = false;

														}	

												}		

										}

								}

							while ($row_functional_areas = mysql_fetch_assoc($functional_areas));	

							//echo (sizeof($order_number));

						}

					$k=0;	

					do

						{

?>

						<tr>

							<td colspan="3" class="style2">

								<a href="manage_database.php?table_name=<?php echo($tablename);?>&action_name=change&key_field=orders&key_field_value=<?php echo $order_number[$k] ?>">

									<?php echo $order_number[$k]; ?>

								</a>

							</td>

						</tr>

<?php 					$k++;

						}

					while ($k<sizeof($order_number));

				}

			else

				{					

?>	

						<tr>

							<td class="style2">

<?php

					if (($col_1_field_name == "") || ($col_1_field_name == " "))

						{

?>

								&nbsp;

<?php

						}

					else

						{

							echo($col_1_field_label);

						}

?>

							</td>

							<td width="20">&nbsp;</td>

							<td class="style2">

<?php

					if (($col_2_field_name == "") || ($col_2_field_name == " "))

						{

?>

								&nbsp;

<?php

						}

					else

						{

							echo($col_2_field_label);

						}

?>

							</td>

						</tr>

<?php

					do			

						{

?>						

						<tr>

							<td colspan="3">

								<hr>

							</td>

						</tr>

						<tr>

							<td valign="top" class="style3">

								<a href="manage_database.php?table_name=<?php echo($tablename);?>&action_name=change&key_field=<?php echo($keyfield);?>&key_field_value=<?php echo $row_functional_areas[$keyfield]; ?>">

<?php

							if (isset($sub_select_1))

								{

									do

										{

											//$row_col1_schema = mysql_fetch_assoc($col1_schema);

/*

											echo("row_col1_schema['id_number'] = ".$row_col1_schema['id_number']."<BR>");

											echo("362 - col_1_field_name = ".$col_1_field_name."<BR>");

											echo("363 - row_functional_areas['col_1_field_name'] = ".$row_functional_areas[$col_1_field_name]."<BR>");

											echo("364 - row_col1_schema['id_number'] = ".$row_col1_schema['id_number']."<BR><BR>");

*/

											if($row_col1_schema['id_number'] == $row_functional_areas[$col_1_field_name])

												{

													//echo("col_1_field_name = ".$col_1_field_label."<BR><BR>");

													$entry = $row_col1_schema[$col_1_field_label];

													//echo("entry = ".$entry."<BR><BR>");

													echo($entry);

													break;

												}

											//echo("375<BR>");

										}

									while($row_col1_schema = mysql_fetch_assoc($col1_schema));

									mysql_data_seek($col1_schema, 0);

									//echo("393 - row_col1_schema[id_number] = ".$row_col1_schema['id_number']."<BR><BR>");

									//echo("394<BR>");

								}

							else

								{

									echo $row_functional_areas[$col_1_field_name];

								}

?>

								</a>

							</td>

							<td>&nbsp;</td>

							<td valign="top" class="style3">

								<a href="manage_database.php?table_name=<?php echo($tablename);?>&action_name=change&key_field=<?php echo($keyfield);?>&key_field_value=<?php echo $row_functional_areas[$keyfield] ?>">

									<?php echo $row_functional_areas[$col_2_field_name]; ?>

								</a>

							</td>

<?php				

						}

					while ($row_functional_areas = mysql_fetch_assoc($functional_areas));

				}	

?>

					</table>

			  </td>	

			</tr>

<?php

		}	

?>

			<tr>

				<td colspan="3"class="style3">

					<a href="../_admin/gp_administration.php">

						Back to Admin					</a>				</td>

			</tr>

		</table>	

	</body>

</html>

<?php

	mysql_free_result($db_schema);

	mysql_free_result($functional_areas);

	mysql_free_result($rsTitle);

?>