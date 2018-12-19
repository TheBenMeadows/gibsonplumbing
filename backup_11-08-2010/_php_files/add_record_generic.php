<?PHP

/*

	add_record_generic.php

	Copyright March, 2006

	This php file is the exclusive property of Glyn Barrows. A right to use permission is granted to Christian Heriatage Schools for use in administering the Christian Heriatage Schools Web Site (chs-kids.com) Web Site

*/

	require_once('required_files.php');

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

	$holder = array();

	$multiple_entry = array();

	$holder_name ="";

	$pic_holder = array();

	$pic_cat= "";

	$SQL_is_set = 0;

	foreach($_POST as $name=>$value )

		{

			//get everything before and after the last underscore.

			//This is done by replacing the last underscore with a finite series of odd characters and then

			//parsing (exploding) on that replacement string. 

			if ((strrpos ( $name, "_"))>0)

				{

					$temp_post_parse = explode("+=_-",substr_replace($name,"+=_-",(strrpos ( $name, "_")),1));

					$x = sizeof($multiple_entry);

					if (is_numeric($temp_post_parse[1]))

						{

							$multiple_entry[$x][0] = $temp_post_parse[0];

							$multiple_entry[$x][1] = $temp_post_parse[1];

						}

				}

		}

	foreach($_GET as $name=>$value )

		{

			if ((strrpos ( $name, "_"))>0)

				{

					$temp_post_parse = explode("+=_-",substr_replace($name,"+=_-",(strrpos ( $name, "_")),1));

					$x = sizeof($multiple_entry);

					if (is_numeric($temp_post_parse[1]))

						{

							$multiple_entry[$x][0] = $temp_post_parse[0];

							$multiple_entry[$x][1] = $temp_post_parse[1];

						}

				}

		}

	if (sizeof($multiple_entry)>1)

		{

			for ($rs = 0;$rs<(sizeof($multiple_entry)-1);$rs++)

				{

					if ($multiple_entry[$rs][0] == $multiple_entry[$rs+1][0])

						{

							$holder_name = $multiple_entry[$rs][0];

							break;

						}

				}

		}

	if (isset($_POST['table_name']) || isset($_GET['table_name']))

		{

			foreach($_POST as $name=>$value )

				{

					switch ($name) 

						{

							case "table_name":

								$tablename = $value;

								break;    

							case "image_category":

								$pic_cat = $value;

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;	 

							case "TypeUpdate":

								$action = $value;

								break;

							case "site":

								$site = $value;

								break;

							case substr($name,0,8)=="box_name":

								//This will accommodate multiple non related FILE (box_name) fields.

								$temp = substr($value,0,strrpos($value,"_"));

								if (!($value == "")&&!($value==" ")&&!($value==NULL))

									{

										if (sizeof($pic_holder) == 0)

											{

												$pic_holder[0][0] = $temp;

												$pic_holder[0][1] = $value;

											}

									}

								else

									{

										if (!($value == "")&&!($value==" ")&&!($value==NULL))

											{

												$found_it = 0;

												for ($i = 0; $i<sizeof($pic_holder);$i++)

													{

																if ($temp == $pic_holder[$i][0])

																	{

																		$found_it = 1;

																		$pic_holder[$i][(sizeof($pic_holder[$i]))] = $value;

																	}

													}

											}

										if ($found_it == 0)

											{

												if (!($value == "")&&!($value==" ")&&!($value==NULL))

													{

														$u = sizeof(pic_holder);

														$pic_holder[$u][0] = $temp;

														$pic_holder[$u][1] = $value;

													}

											}

									}

								break;

							case !($holder_name == NULL) && substr($name,0,strlen($holder_name)) == $holder_name:

								//This will accommodate a list of things like bullets, properties, etc.

								//They will go into their own table and will have a foreign key to something.

								$temp = $holder_name;

								$x = sizeof($holder);

								if (sizeof($holder) == 0)

									{

										if (!($value == "")&&!($value==" ")&&!($value==NULL))

											{

												$holder[0][0] = $temp;

												$holder[0][1] = $value;

											}

									}

								else

									{

										if (!($value == "")&&!($value==" ")&&!($value==NULL))

											{

												$found_it = 0;

												for ($i = 0; $i<sizeof($holder);$i++)

													{

														if ($temp == $holder[$i][0])

															{

																		$found_it = 1;

																		$holder[$i][(sizeof($holder[$i]))] = $value;

															}

													}

											}

										if ($found_it == 0)

											{

												if (!($value == "")&&!($value==" ")&&!($value==NULL))

													{

														//echo("value = ".$value."<BR>");

														$u = sizeof(holder);

														$holder[$u][0] = $temp;

														$holder[$u][1] = $value;

													}

											}

									}

								break;

							case substr($name,0,6)=="length":

								if (substr($name,7,6) == "inches")

									{

										$temp_length_array[1] = $value;

									}

								if (substr($name,7,4) == "feet")

									{

										$temp_length_array[0] = $value;

									}

								break;

						}

				}

			foreach($_GET as $name=>$value )

				{

					switch ($name) 

						{

							case "table_name":

								$tablename = $value;

								break;

							case "image_category":

								$pic_cat = $value;

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;

							case "TypeUpdate":

								$action = $value;

								break;

							case "site":

								$site = $value;

								break;

							case substr($name,0,8)=="box_name":

								//This will accommodate multiple non related FILE (box_name) fields.

								$temp = substr($value,0,strrpos($value,"_"));

								if (sizeof($pic_holder) == 0)

									{

										if (!($value == "")&&!($value==" ")&&!($value==NULL))

											{

												$pic_holder[0][0] = $temp;

												$pic_holder[0][1] = $value;

											}

									}

								else

									{

										$found_it = 0;

										for ($i = 0; $i<sizeof($pic_holder);$i++)

											{

												if (!($value == "")&&!($value==" ")&&!($value==NULL))

													{

														if ($temp == $pic_holder[$i][0])

															{

																$found_it = 1;

																$pic_holder[$i][(sizeof($pic_holder[$i]))] = $value;

															}

													}

											}

										if ($found_it == 0)

											{

												if (!($value == "")&&!($value==" ")&&!($value==NULL))

													{

														$u = sizeof(pic_holder);

														$pic_holder[$u][0] = $temp;

														$pic_holder[$u][1] = $value;

													}

											}

									}

								break;

							case !($holder_name == NULL) && substr($name,0,strlen($holder_name)) == $holder_name:

								//This will accommodate a list of things like bullets, properties, etc.

								//They will go into their own table and will have a foreign key to something.

								$temp = $holder_name;

								$x = sizeof($holder);

								if (sizeof($holder) == 0)

									{

										if (!($value == "")&&!($value==" ")&&!($value==NULL))

											{

												$holder[0][0] = $temp;

												$holder[0][1] = $value;

											}

									}

								else

									{

										$found_it = 0;

										for ($i = 0; $i<sizeof($holder);$i++)

											{

												if ($temp == $holder[$i][0])

													{

														if (!($value == "")&&!($value==" ")&&!($value==NULL))

															{

																$found_it = 1;

																$holder[$i][(sizeof($holder[$i]))] = $value;

															}

													}

											}

										if ($found_it == 0)

											{

												if (!($value == "")&&!($value==" ")&&!($value==NULL))

													{

														//echo("value = ".$value."<BR>");

														$u = sizeof(holder);

														$holder[$u][0] = $temp;

														$holder[$u][1] = $value;

													}

											}

									}

								break;

							case substr($name,0,6)=="length":

								if (substr($name,7,6) == "inches")

									{

										$temp_length_array[1] = $value;

									}

								if (substr($name,7,4) == "feet")

									{

										$temp_length_array[0] = $value;

									}

								break;

						}

				}

		}

	//the actual value in $holder is a field name with a numeric midfier.

	//This next code removes the modifier and store sthe basic field name into a variable called 

	//$insert_non_pic_fld_nme

	if (isset($holder[0][0]))

		{

			if (strrpos($holder[0][0],"_")>0)

				{

					$insert_non_pic_fld_nme = substr($holder[0][0],0,strrpos($holder[0][0],"_"));

				}

			else

				{

					//Just in case there is no numeric modifier.. Should never happen

					$insert_non_pic_fld_nme = substr($holder[0][0],0);

				}

		}

	if (isset($holder[0][0]))

		{

			if (strrpos($pic_holder[0][0],"_")>0)

				{

					$insert_pic_fld_nme = substr($pic_holder[0][0],0,strrpos($pic_holder[0][0],"_"));

				}

			else

				{

					//Just in case there is no numeric modifier.. Should never happen

					$insert_pic_fld_nme = substr($pic_holder[0][0],0);

				}



		}

			//Set the action for a return back to the calling page if the ID check below fails

	$action .= "_".$tablename;

	mysql_select_db($main_db, $conn_main_db);

	$schema_query = "SELECT * FROM db_schema WHERE table_name='$tablename'";

	//echo("HERE<BR>");

	$rs_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

	$row_rs_schema = mysql_fetch_assoc($rs_schema);

	$totalRows_rs_schema = mysql_num_rows($rs_schema);

	//Get a second record set to use in a nested do if needed

	$rs_schema2 = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

	$totalRows_rs_schema2 = mysql_num_rows($rs_schema2);//echo("tablename = ".$tablename."<BR><BR>");

	$the_table_query = "SELECT * FROM ".$tablename;

	//echo("HERE,<BR>");

	$the_table = mysql_query($the_table_query, $conn_main_db) or die(mysql_error()); 

	$row_the_table = mysql_fetch_assoc($the_table);

	$totalRows_the_table = mysql_num_rows($the_table);

	//The first thing to be checked is the id the user has entered.

	//If it is an existing id then the user must enter a different one. 

	//This check will be performed until a unique id is entered

	$id_flag = 'good';

	if($tablename == 'administrator' )

		{

			if (isset($_POST['id']))

				{

					$id_check = $_POST['id'];

					for ($i=0;$i<$totalRows_the_table;$i++)

						{

							if ($row_the_table['id']== $id_check)

								{

									//if the id is bad set the id_flag to bad and set the URL to go back to the input stuff.

									$id_flag='bad';

									$gotoURL = 'manage_database.php?';

									break;

								}

							$row_the_table = mysql_fetch_assoc($the_table);							

						}

				}

			elseif (isset($_GET['id']))

				{

					$id_check = $_GET['id'];

					for ($i=0;$i<$totalRows_the_table;$i++)

						{

							if ($row_the_table['id']== $id_check)

								{

									//if the id is bad set the id_flag to bad and set the URL to go back to the input stuff.

									$id_flag='bad';

									$gotoURL = 'manage_database.php?';

									break;

								}

							$row_the_table = mysql_fetch_assoc($the_table);							

						}

				}

		}		

	if ($id_flag =='good')

		{

			$insert_sql = "INSERT INTO $tablename ";

			$insert_sql_values = "(";

			$insert_sql_fields = "(";

			$q=0;

			$temp_date_field_names = array();

			//First get all of the various date field names to be posted.

			//To do, look for every instance of "month" in the $_GET and $_POST variables.

			//Since each date field will have a single month listed, this can be used toextract the date's field name.

			//These field names will be stored into an ARRAY variable called $temp_date_field_name.

			foreach($_POST as $name=>$value)

				{

					if(substr($name, -5) == "month")

						{

							$temp_date_field_names[] = substr($name,0, -6);

						}

				}

			foreach($_GET as $name=>$value)

				{

					if(substr($name, -5) == "month")

						{

							$temp_date_field_names[] = substr($name,0, -6);

						}

				}

			for ($i=0;$i<count($temp_date_field_names);$i++)

				{

					foreach($_POST as $name=>$value)

						{

							if(substr($name, -4) == "year"&& substr($name,0, -5)==$temp_date_field_names[$i])

								{

									$temp_date_array[0] = $value;

								}

							if(substr($name, -5) == "month" && substr($name,0, -6)==$temp_date_field_names[$i])

								{

									$temp_date_array[1] = $value;

								}

							if(substr($name, -3) == "day"&& substr($name,0, -4)==$temp_date_field_names[$i])

								{

									$temp_date_array[2] = $value;

								}

						}

					foreach($_GET as $name=>$value)

						{

							if(substr($name, -4) == "year"&& substr($name,0, -5)==$temp_date_field_names[$i])

								{

									$temp_date_array[0] = $value;

								}

							if(substr($name, -5) == "month" && substr($name,0, -6)==$temp_date_field_names[$i])

								{

									$temp_date_array[1] = $value;

								}

							if(substr($name, -3) == "day"&& substr($name,0, -4)==$temp_date_field_names[$i])

								{

									$temp_date_array[2] = $value;

								}

						}

					//The following formats the date like this (month day, year....december 3, 2001)

					$theDate = $temp_date_array[1]." ".$temp_date_array[2].", ".$temp_date_array[0];

					$temp_date=	getUNIXreadyDate($theDate, 1);

					//NOTE: the _GET or _POST strings passed in will  have _month or _year or _day for the various dates being posted

					//to the database.  The database  "db_schema" shows the actual field names without those modifiers.

					//So now this data needs to be added to the SQL insert statement

					if ($q == 0)

						{

							$insert_sql_fields .=$temp_date_field_names[$i];

							$insert_sql_values .= "'".$temp_date."'";

							$q=1;

						}

					else

						{

							$insert_sql_fields .=",".$temp_date_field_names[$i];

							$insert_sql_values .= ",'".$temp_date."'";

						}	

				}

			if (isset($temp_length_array) && (sizeof($temp_length_array) > 0))

				{

					if ($q == 0)

						{

							$insert_sql_fields .= "length";

							$insert_sql_values .= "'".$temp_length_array[0]."\'".$temp_length_array[1]."\"'";

							$q=1;

						}

					else

						{

							$insert_sql_fields .=", length";

							$insert_sql_values .= ",'".$temp_length_array[0]."\'".$temp_length_array[1]."\"'";

						}	

				}

			$like_item = 1;

			for ($i=0;$i<$totalRows_rs_schema;$i++)

				{

					//look for all rows that have a valid field name

					if ($row_rs_schema['field_name'] <> "NONE_TITLE_ONLY")

						{

							if (($row_rs_schema['field_name'] == "approved_status") && !(isset($_REQUEST['approved_status'])))

								{

									if ($q == 0)

										{

											$insert_sql_fields .="approved_status";

											$insert_sql_values .= "'F'";

											$temp = NULL;

											$q=1;

										}

									else

										{

											$insert_sql_fields .=",approved_status";;

											$insert_sql_values .= ",'F'";

											$temp = NULL;

										}	

								}

							else if (($row_rs_schema['field_name'] == "approved_status") && (isset($_REQUEST['approved_status'])))

								{

									if ($q == 0)

										{

											$insert_sql_fields .="approved_status";

											$insert_sql_values .= ",'". $_REQUEST['approved_status']."'";

											$temp = NULL;

											$q=1;

										}

									else

										{

											$insert_sql_fields .=",approved_status";;

											$insert_sql_values .=",'". $_REQUEST['approved_status']."'";

											$temp = NULL;

										}

								}

							else

								{								

									$temp = $row_rs_schema['field_name'];

								}

							//The following counts "like" items.  This applies to everything except uploaded stuff like images, pdfs, etc.

							//check to see if a value was sent for the field name

							//echo("TEMP = ".$temp."<BR>");

							if (isset($_POST[$temp]))

								{

									//echo("field = ".$row_rs_schema['field_name']." and type = ".$row_rs_schema['field_type']."<BR>");	

									if ($q == 0)

										{

											$insert_sql_fields .= $row_rs_schema['field_name'];

											if ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn" || (($row_rs_schema['field_type']== "list") /*&& ($row_rs_schema['field_list_code'] == 3)*/))

												{

						

												if (($_POST[$temp] == NULL) || ($_POST[$temp] == "") || ($_POST[$temp] ==" "))

														{

															$insert_sql_values .= 0;

														}

													else

														{		

															$insert_sql_values .= $_POST[$temp];

														}

												}

											else

												{	

													$insert_sql_values .= "'".$_POST[$temp]."'";

												}

											$q=1;

										}

									else

										{	

											$insert_sql_fields .= ",".$row_rs_schema['field_name'];

											$num_val = 0;

											if ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn" || (($row_rs_schema['field_type']== "list") /*&& ($row_rs_schema['field_list_code'] == 3)*/))

												{

													if (($_POST[$temp] == NULL) || ($_POST[$temp] == "") || ($_POST[$temp] ==" "))

														{

															$insert_sql_values .= ",".$num_val;

														}

													else

														{		

															$insert_sql_values .= ",".$_POST[$temp];

														}

												}

											else	

												{	

													$insert_sql_values .= ",'".$_POST[$temp]."'";

												}

										}

								}

							elseif (isset($_GET[$temp]))

								{

									if ($q == 0)

										{

											$insert_sql_fields .= $row_rs_schema['field_name'];

											if ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn" || ($row_rs_schema['field_type']== "list" && (!($row_rs_schema['field_list_code'] == 1))))

												{

													$insert_sql_values .= $_GET[$temp];

												}

											else 

												{	

													$insert_sql_values .= "'".$_GET[$temp]."'";

												}

											$q=1;

										}

									else

										{	

											$insert_sql_fields .= ",".$row_rs_schema['field_name'];

											if ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn" || ($row_rs_schema['field_type']== "list" && (!($row_rs_schema['field_list_code'] == 1))))

												{

													$insert_sql_values .= ",".$_GET[$temp];

												}

											else

												{	

													$insert_sql_values .= ",'".$_GET[$temp]."'";

												}

										}

								}

							elseif ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn" || $row_rs_schema['field_type']== "list" )

								{

									//If numeric data was not entered for a legitimate dbase field, the put a zero '0' there.

									if ($q == 0)

										{

											$insert_sql_fields .= $row_rs_schema['field_name'];

											$insert_sql_values .= 0;

											$q=1;

										}

									else

										{

											$qq = 0;	

											$insert_sql_fields .= ",".$row_rs_schema['field_name'];

											$insert_sql_values .= ",".$qq;

										}

								}

						}

					$row_rs_schema = mysql_fetch_assoc($rs_schema);	

				}					

			//reset the schema table and get the first record

			mysql_data_seek($rs_schema, 0);

			$row_rs_schema = mysql_fetch_assoc($rs_schema);	

			if (sizeof($_FILES)>0)

				{

					$unique_folder_name = get_unique_folder($row_rs_schema,$totalRows_rs_schema,$rs_schema,$main_db,$conn_main_db,$tablename,"NONE");

					//echo("pic cat = ".$pic_cat."<BR>");	



					$the_path_array = get_path($site,$main_db,$conn_main_db,$tablename,$pic_cat);

					$the_path = $the_path_array[0];

					if (isset($the_path_array[1]))

						$pic_sizes = $the_path_array[1];

					//Build the required folders by calling the functin build_folder

					if ($site == "admin")

						{

							$temp_path = "../";

							$move_to_path = "../image_uploads";

						}

					else

						{	

							$temp_path ="";

							$move_to_path = "image_uploads";

						}

					for($j=0;$j<sizeof($pic_holder);$j++)

						{

							for($k=0;$k<sizeof($pic_holder[$j]);$k++)

								{

									//echo($pic_holder[$j][$k]."<br>".$j."<BR>".$k);

									if (is_uploaded_file($_FILES[$pic_holder[$j][$k]]['tmp_name']))

										{

											$image_names[sizeof($image_names)] = basename($_FILES[$pic_holder[$j][$k]]['name']);

											if (substr($image_names[sizeof($image_names)-1],-5)==".JPEG"||substr($image_names[sizeof($image_names)-1],-5)==".jpeg")

												{

													$image_names[sizeof($image_names)-1] = substr($image_names[sizeof($image_names)-1],0,strpos($image_names[sizeof($image_name)-1],".")).".jpg";

												}

											$from = $_FILES[$pic_holder[$j][$k]]['tmp_name'];

											$to = $move_to_path."/".$_FILES[$pic_holder[$j][$k]]['name'];

											$move_success = move_uploaded_file($from,$to); 

										}

								}

						}

					for($i = 0;$i<sizeof($pic_sizes);$i++)

						{

							$the_path1 = $the_path.$pic_sizes[$i][0]."/".$unique_folder_name."/";

							if (!(build_folder($the_path1)))

								{

									//If the folder creation was not a success

									header("Location: site_error_page?msg=Folder creation failed.  Please alert the web administrator");

								}

							if ($move_success)

								{

									//if (is_uploaded_file($_FILES[$pic_holder[$j][$k]]['tmp_name']))

									for ($j=0;$j<sizeof($image_names);$j++)

										{

											$image_target_folder_path = $the_path.$pic_sizes[$i][0]."/".$unique_folder_name."/";

											create_image($image_names[$j],$pic_sizes[$i][1],$pic_sizes[$i][2],$move_to_path,$image_target_folder_path,$pic_sizes[$i][0]);

											//delete_file($to);

											$process_picture = "f";

										}

								}

	

						}

				}

			//The following if statement is for the 3 creative hearts web site.

			//It establishes a new folder for the pictures of an artists works.

			$temp_values = $insert_sql_values;

			$insert_sql_values = "";

			if (isset($pic_holder) &&(sizeof($pic_holder)==1))

				{

					//If there is only one image type in the pic holder, then it is possible that 

					//there will be a list of images uploaded and these will be stand alone insert values

					$insert_sql_fields .= ",".$pic_holder[0][0];

					$insert_sql_values .= $temp_values.",'".$_FILES[$pic_holder[0][1]]['name']."'";

					$insert_sql_values .=",'$Thedate') ";

					for ($j=0; $j<sizeof($_FILES)-1;$j++)

						{

							$insert_sql_values .= ",".$temp_values.",'".$_FILES[$pic_holder[0][$j+2]]['name']."'";

							$insert_sql_values .=",'$Thedate') ";

						}

					$insert_sql_fields .=",date_added)";

					$insert_sql .= $insert_sql_fields." VALUES ".$insert_sql_values.";";

					$SQL_is_set =1;

				}

			else if (isset($pic_holder) &&(sizeof($pic_holder)>1))

				{

					for ($i = 0;$i<sizeof($pic_holder);$i++)

						{

							$insert_sql_fields .= ",".$pic_fld_holder[$i][0];

							//Then there will only be one image for each type in the entered data

							//In other words it will not be a list of files.

							$insert_sql_values .= ",'".$_FILES[$pic_holder[$i][1]]['name']."'";

						}

					$insert_sql_fields .=",date_added)";

					$insert_sql_values .=",'$Thedate') ";

					//capture the values

					$insert_sql .= $insert_sql_fields." VALUES ".$insert_sql_values.";";

					$SQL_is_set =1;

				}

			if (sizeof($holder)==1)

				{

					$insert_sql_fields .= ",".$holder[0][0];

					$insert_sql_values .= $temp_values.",'".$holder[0][1]."'";

					$insert_sql_values .=",'$Thedate') ";

					for ($j=2; $j<sizeof($holder[0]);$j++)

						{

							$insert_sql_values .= ",".$temp_values.",'".$holder[0][$j]."'";

							$insert_sql_values .=",'$Thedate') ";

						}

					$insert_sql_fields .=",date_added)";

					$insert_sql .= $insert_sql_fields." VALUES ".$insert_sql_values.";";

					$SQL_is_set =1;

				}

			else if (sizeof($holder) == 0)

				{

					$insert_sql_values = $temp_values;

				}

			if ((sizeof($holder)==0)&&(sizeof($pic_holder)==0))

				{

					$insert_sql_fields .=",date_added) ";

					$insert_sql_values .=",'$Thedate')";

					if (!$SQL_is_set)

						$insert_sql .= $insert_sql_fields." VALUES ".$insert_sql_values.";";

				}

			else

				{

					$insert_sql_fields .=",date_added) ";

					$insert_sql_values .=",'$Thedate')";

					if (!$SQL_is_set)

						$insert_sql .= $insert_sql_fields." VALUES ".$insert_sql_values.";";

				}

						$success = mysql_query($insert_sql, $conn_main_db);

				

							

							

/*	

			FORTESTING	

		echo("Success on insert = ".$success."<BR><BR>");

			success_test($success);

			echo("Insert SQL = ".$insert_sql."<BR><BR>insert_sql_fields = ".$insert_sql_fields."<BR>insert_sql_values = ".$insert_sql_values."<BR><BR>");

*/				

	

			mysql_free_result($rs_schema);

			mysql_free_result($rs_schema2);

			if (isset($rs_pic_cat))

				{

					mysql_free_result($rs_pic_cat);

				}

			if (isset($rs_temp))

				{

					mysql_free_result($rs_temp);

				}

			if (isset($rs_temp1))

				{

					mysql_free_result($rs_temp1);

				}

			mysql_free_result($the_table);

			header("Location: $gotoURL?done=done");

		}

	else

		{

			foreach($_POST as $name=>$value)

				{

					$gotoURL .= $name."=".$value."&";

				}

			foreach($_GET as $name=>$value)	

				{

					$gotoURL .= $name."=".$value."&";

				}

			header("Location: $gotoURL?action=".$action."done=done");

		}

?>