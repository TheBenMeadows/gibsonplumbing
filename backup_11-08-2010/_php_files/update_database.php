<?PHP

/*

update_database.php

Copyright March, 2006

This php file is the exclusive property of Glyn Barrows.

A right to use permission is granted to Gruene Acres Web Design for use in administering the All Star RV Web Site

*/

	require_once('required_files.php');

?>

<?php

	$temp_date_field_names = array();

	$update_set = "";

	$mail_flag=false;

	$message = "";

	$whoto = "";

	$process_picture = "f";

	$temp_path = "";

	$type = array();

	$Thedate = date("Y-m-d");

	$holder = array();

	$multiple_entry = array();

	$field_list = "";

	$field_values = "";

	mysql_select_db($main_db, $conn_main_db);

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

/*

	if (!

	mysql_select_db($main_db, $conn_main_db);

	//first schema recordset

	$schema_query = "SELECT * FROM db_schema WHERE table_name = '".$tablename."';";

	$rs_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

	//second schema recordset

	$rs_schema2 = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

	//get the first record from the first recordset

	$row_rs_schema = mysql_fetch_assoc($rs_schema);

	//get the number of records retrieved

	$totalRows_rs_schema = mysql_num_rows($rs_schema);

*/	//If this is called by a contact form..... the action will equal submit_contact

	//This if will accommodate either a _POST or a _GET

	//retrieve two identical recoredsets based on the schema table. 

 	if(((isset($_POST['action']))&&(($_POST['action']=="submit_contact")))||(((isset($_GET['action']))&&(($_GET['action']=="submit_contact")))))

		{

			//If it is a _POST then get the values

			//echo ("Type of contact = ".$contact_action."<BR><BR>");

			foreach($_POST as $name=>$value)

				{

					if (substr($name,0, 8)=="changed_")

						{

							$name = substr($name,9);

						}

					switch ($name)

						{

							case "subject":

								$subj = $value;

								break;    

							case "from":

								$from = $value;

								break;

							case "guest_first_name":

								$from1 = $value;

								break;	

							case "guest_last_name":

								$from2 = $value;

								break;	

							case "email_id":

								$to = $value;

								break;	    

							case "contact_message":

								$mess = $value;

								break;    

							case "phone":

								$ph = $value;

								break;

							case "address":

								$addr = $value;

								break;

							case "city":

								$city = $value;

								break;

							case "state":

								$state = $value;

								break;	

							case "mail_code":

								$mc = $value;

								break;

							case "type":

								//Type represents the type of request.  This is used to determine who gets the message 

								$x = sizeof($type);

								if (strlen($value) >0)

									{

										$type[$x][0] = $name;

										$type[$x][1] = $value;

									}

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;

						}

				}

			//If it is a _GET then get the values

			foreach($_GET as $name=>$value)	

				{

					//echo("G-sub string = ".substr($name,0, 3)."<BR>");

					//echo("rest of string = ".substr($name,3)."<BR>");

					if (substr($name,0, 8)=="changed_")

						{

							$name = substr($name,9);

						}

					switch ($name)

						{

							case "subject":

								$subj = $value;

								break;    

							case "from":

								$from = $value;

								break;

							case "guest_first_name":

								$from1 = $value;

								break;	

							case "guest_name":

								$from1 = $value;

								break;	

							case "guest_last_name":

								$from2 = $value;

								break;	

							case "email_id":

								$to = $value;

								break;	    

							case "contact_message":

								$mess = $value;

								break;    

							case "phone":

								$ph = $value;

								break;

							case "address":

								$addr = $value;

								break;

							case "city":

								$city = $value;

								break;

							case "state":

								$state = $value;

								break;	

							case "mail_code":

								$mc = $value;

								break;

							case "type":

								//Type represents the type of request.  This is used to determine who gets the message 

								$x = sizeof($type);

								if (strlen($value) >0)

									{

										$type[$x][0] = $name;

										$type[$x][1] = $value;

									}

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;

						}

				}

			if (!isset($subj))

				{

					$subj = "Contact from Website.";

/**************ENTER EMAIL IDS in the FOLLOWING Variable************************/

					$whoto = "";

				}

			if (!isset($from))

				{

					$from = $from1." ".$from2;

				}	

			$message .= "\nSubject:  ".$subj."\n";

			$message .= "\nFrom:  ".$from."\n";

			//If the requestor's email is neither null nor blank (space) add the email to the message

			if (isset($to)) 

				{

					if ($to <> "" && $to <> " ")

						{

							$message .= "Email ID - ".$to."\n";

						}

				}		

			//If the requestor's Phone number is neither null nor blank (space) add the email to the message

			if (isset($ph)) 

				{

					if ($ph <> "" && $ph <> " ")

						{

							$message .= "Phone Number - ".$ph."\n";

						}

				}		

			//If the requestor's address is neither null nor blank (space) add the email to the message

			if (isset($addr)) 

				{

					if ($addr <> "" && $addr <> " ")

						{

							$message .= "Address:\n";

							$message .= "    ".$addr."\n";

							$message .= "    ".$city."\n";

							$message .= "    ".$mc."\n";

						}	

				}		

			$message .= "\n".$mess."\n\n  END OF MESSAGE!!";

			//Mail the message to the appropriate person based on what is being requested.

/*

			for testing

			echo ("mail (".$whoto.",".$subj.",".$message.")<BR><BR>");

*/

/*

			remove above statement and UNCOMMENT the statement below when ready to test on line tested

			echo ("Mail sent ---> ".$whoto.", ".$subj.", ".$message."<BR><BR>");

*/		

			if (!($whoto == ""))

				{

					mail ($whoto, $subj, $message);

				}

			else

				{

					mail ("gmb7777@sbcglobal.net", "error from ".$database_conn_asrv." web site", "message = ".$message);

				}

		}

	else

		{	

			//The previous stuff only processed the contact email notification and since

			//the web site contact form must allow for the updating of customer data,

			//the following processes all types of updates.

			//NOTE: the _GET or _POST strings passed in will  have _month or _year or _day for the various dates being posted

			//to the database.  The database  "db_schema" shows the actual field names without those modifiers.

			foreach($_POST as $name=>$value )

				{

					//Get all of the various date field names to be posted.

					//First deal with any date entries.  Look for every instance of "month" in the $_GET and $_POST variables.

					//Since each date field will have a single month listed, this can be used to extract the date's field name.

					//These field names will be stored into an ARRAY variable called $temp_date_field_name.

					if(substr($name, -5) == "month")

						{

							$temp_date_field_names[] = substr($name,0, -6);

						}

					//Get everything after the last underscore.

					//This is done by replacing the last underscore with a finite series of odd characters and then

					//parsing (exploding) on that replacement string. 

					if (!(substr($name,0, 8)=="changed_"))

						{

							$temp = $name;

							$temp_post_parse = explode("+=_-",substr_replace($temp,"+=_-",(strrpos($temp, "_")),1));

							$x = sizeof($multiple_entry);

							$multiple_entry[$x][0] = $temp_post_parse[0];

							$multiple_entry[$x][1] = $temp_post_parse[1];

						}

					if ($name =="table_name")	

						{

							$tablename = $value;

							//first schema recordset

							$schema_query = "SELECT * FROM db_schema WHERE table_name = '".$tablename."';";

							$rs_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

							//second schema recordset

							$rs_schema2 = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

							//get the first record from the first recordset

							$row_rs_schema = mysql_fetch_assoc($rs_schema);

							//get the number of records retrieved

							$totalRows_rs_schema = mysql_num_rows($rs_schema);

						}

				}

			foreach($_GET as $name=>$value )

				{

					//Get all of the various date field names to be posted.

					//First deal with any date entries.  Look for every instance of "month" in the $_GET and $_POST variables.

					//Since each date field will have a single month listed, this can be used to extract the date's field name.

					//These field names will be stored into an ARRAY variable called $temp_date_field_name.

					if(substr($name, -5) == "month")

						{

							$temp_date_field_names[] = substr($name,0, -6);

						}

					if (!(substr($name,0, 8)=="changed_"))

						{

							$temp = $name;

							$temp_post_parse = explode("+=_-",substr_replace($temp,"+=_-",(strrpos($temp, "_")),1));

							$x = sizeof($multiple_entry);

							$multiple_entry[$x][0] = $temp_post_parse[0];

							$multiple_entry[$x][1] = $temp_post_parse[1];

						}

					if ($name =="table_name")	

						{

							$tablename = $value;

							//first schema recordset

							$schema_query = "SELECT * FROM db_schema WHERE table_name = '".$tablename."';";

							$rs_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

							//second schema recordset

							$rs_schema2 = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

							//get the first record from the first recordset

							$row_rs_schema = mysql_fetch_assoc($rs_schema);

							//get the number of records retrieved

							$totalRows_rs_schema = mysql_num_rows($rs_schema);

						}

				}

			if (sizeof($multiple_entry)>1)

				{

					for ($rs = 0;$rs<sizeof($multiple_entry);$rs++)

						{

							if ($multiple_entry[$rs][0] == $multiple_entry[$rs+1][0])

								{

									$holder_name = $multiple_entry[$rs][0];

									break;

								}

						}

				}

			foreach($_POST as $name=>$value )

				{

					switch ($name)

						{

							case "category_id":

								$pic_cat = $value;

								break;

							case "image_category":

								$pic_cat = $value;

								break;

							case "key_field":

								$keyfield = $value;

								break;

							case "key_field_value":

								$keyfieldvalue=$value;

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;

							case "site":

								$site = $value;

								break;

							case substr($name,0,6)=="length":



								if (substr($name,7,6) == "inches")

									{

										$temp_length_array[1] = $value;

									}

								if (substr($name,7,4) == "feet")

									{

										//echo("length = ".substr($name,7,4)."<BR>");

										$temp_length_array[0] = $value;

									}

								break;

							case (substr($name,0, 8)=="changed_"):

									{				

										$name1=(substr($name,8));

										if (substr($name1,7,4) == "feet")

											{

												$temp_length_array[0] = $value;

											}

										if (substr($name1,7,6) == "inches")

											{

												$temp_length_array[1] = $value;

											}

										if(!(substr($name, -4) == "year") && !(substr($name, -5) == "month") && !(substr($name, -3) == "day"))// && !($name == "action")&&!($name=="contact_message"))

											{

												for ($i=0;$i<$totalRows_rs_schema;$i++)

													{

														if ($row_rs_schema['field_name'] == $name1)

															{

																$update_set .= $name1."='".$value."',";

																$field_list .=$name1.",";

																if (($row_rs_schema['field_type'] == "numeric") || ($row_rs_schema['field_type']== "phone") || ($row_rs_schema['field_type']== "ssn") || (($row_rs_schema['field_type']== "list") && ($row_rs_schema['field_list_code'] == 3)))

																	{

																		$field_values .=$value.",";

																	}

																else

																	{	

																		$field_values .= "'".$value."',";

																	}

																mysql_data_seek ($rs_schema,0);

																$row_rs_schema = mysql_fetch_assoc($rs_schema);

																break;	

															}

														$row_rs_schema = mysql_fetch_assoc($rs_schema);

													}

											}

										break;

									}

								

							case (substr($name,0,8)=="box_name"):

								//This will accommodate multiple non related FILE (box_name) fields.

								$temp = substr($value,0,strrpos($value,"_"));

								if (sizeof($pic_holder) == 0)

									{

										$pic_holder[0][0] = $temp;

										$pic_holder[0][1] = $value;

										//echo("pic_holder[0][0] = ".$pic_holder[0][0]."<BR><BR>");

										//echo("pic_holder[0][1] = ".$pic_holder[0][1]."<BR><BR>");

									}

								else

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

										if ($found_it == 0)

											{

												$u = sizeof(pic_holder);

												$pic_holder[$u][0] = $temp;

												$pic_holder[$u][1] = $value;

											}

									}

//								$i = sizeof($pic_holder);

//								$pic_holder[$i] = $value;

								$update_set .= $value."='".$_FILES[$pic_holder[0][1]]['name']."',";

								//echo("update set addition = ".$_FILES[$pic_holder[0][1]]['name']."<BR><BR>");

								break;

							case (substr($name,0,strlen($holder_name)) == $holder_name):

								$x = sizeof($holder);

								if (strlen($holder_name) >0)

									{

										$holder[$x][0] = $holder_name;

										$holder[$x][1] = $value;

									}

								break;

							default:

								break;

						}

				}

			foreach($_GET as $name=>$value )

				{

					switch ($name)

						{

							case "category_id":

								$pic_cat = $value;

								break;

							case "key_field":

								$keyfield = $value;

								break;

							case "key_field_value":

								$keyfieldvalue=$value;

								break;

							case "gotoURL":

								$gotoURL = $value;

								break;

							case "site":

								$site = $value;

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

							case (substr($name,0, 8)=="changed_"):

									{				

										$name1=(substr($name,8));

										if (substr($name1,8,4) == "feet")

											{

												$temp_length_array[0] = $value;

											}

										if (substr($name1,8,6) == "inches")

											{

												$temp_length_array[1] = $value;

											}

										if(!(substr($name, -4) == "year") && !(substr($name, -5) == "month") && !(substr($name, -3) == "day"))// && !($name == "action")&&!($name=="contact_message"))

											{

												for ($i=0;$i<$totalRows_rs_schema;$i++)

													{

														if ($row_rs_schema['field_name'] == $name1)

															{

																$update_set .= $name1."='".$value."',";

																$field_list .=$name1.",";

																if ($row_rs_schema['field_type'] == "numeric" || $row_rs_schema['field_type']== "phone" || $row_rs_schema['field_type']== "ssn")

																	{

																		$field_values .=$value.",";

																	}

																else

																	{	

																		$field_values .= "'".$value."',";

																	}

																mysql_data_seek ($rs_schema,0);

																$row_rs_schema = mysql_fetch_assoc($rs_schema);

																break;	

															}

														$row_rs_schema = mysql_fetch_assoc($rs_schema);

													}

											}

										break;

									}

							

							case (substr($name,0,8)=="box_name"):

								//This will accommodate multiple non related FILE (box_name) fields.

								$temp = substr($value,0,strrpos($value,"_"));

								if (sizeof($pic_holder) == 0)

									{

										$pic_holder[0][0] = $temp;

										$pic_holder[0][1] = $value;

										//echo("pic_holder[0][0] = ".$pic_holder[0][0]."<BR><BR>");

										//echo("pic_holder[0][1] = ".$pic_holder[0][1]."<BR><BR>");

									}

								else

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

										if ($found_it == 0)

											{

												$u = sizeof(pic_holder);

												$pic_holder[$u][0] = $temp;

												$pic_holder[$u][1] = $value;

											}

									}

//								$i = sizeof($pic_holder);

//								$pic_holder[$i] = $value;

								$update_set .= $temp."='".$_FILES[$pic_holder[0][1]]['name']."',";

								//echo("update set addition = ".$_FILES[$pic_holder[0][1]]['name']."<BR><BR>");

								break;

							case (substr($name,0,strlen($holder_name)) == $holder_name):

								$x = sizeof($holder);

								if (strlen($holder_name) >0)

									{

										$holder[$x][0] = $holder_name;

										$holder[$x][1] = $value;

									}

								break;

							default:

								break;

						}

				}

			



			if (sizeof($temp_length_array) > 0)

				{

					$update_set .= "length='".$temp_length_array[0]."\'".$temp_length_array[1]."\"',";

					//echo(sizeof($temp_length_array)."<BR><BR>");

				}				

/*

			mysql_select_db($main_db, $conn_main_db);

			//first schema recordset

			$schema_query = "SELECT * FROM db_schema WHERE table_name = '".$tablename."';";

			$rs_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

			//second schema recordset

			$rs_schema2 = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

			//get the first record from the first recordset

			$row_rs_schema = mysql_fetch_assoc($rs_schema);

			//get the number of records retrieved

			$totalRows_rs_schema = mysql_num_rows($rs_schema);

*/

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

					$update_set .= $temp_date_field_names[$i]."='".$temp_date."',";

				}

			if (isset($_GET['table_name']))

				{

					$schema_query = "SELECT * FROM db_schema WHERE table_name='".$_GET['table_name']."'";

				}

			else if (isset($_POST['table_name']))

				{

					$schema_query = "SELECT * FROM db_schema WHERE table_name='".$_POST['table_name']."'";

				}

			mysql_data_seek ($rs_schema,0);

			$row_rs_schema = mysql_fetch_assoc($rs_schema);

			if (sizeof($_FILES)>0)

				{

					$unique_folder_name = get_unique_folder($row_rs_schema,$totalRows_rs_schema,$rs_schema,$main_db,$conn_main_db,$tablename,"NONE");

					//echo("608 - unique folder name = ".$pic_cat."<br><BR>");

					$the_path_array = get_path($site,$main_db,$conn_main_db,$tablename,$pic_cat);

					$the_path = $the_path_array[0];

					//echo("611 - the path before exploding = ".$the_path."<BR>");

					$pic_sizes = $the_path_array[1];

					//echo("sizeof the_path_array = ".sizeof($the_path_array)."<BR><BR>");

					//echo("sizeof pic_sizes array = ".sizeof($pic_sizes)."<BR><BR>");

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

					//echo("674 - AT line 674<BR><BR>");

					//echo("sizeof(pic_holder) = ".sizeof($pic_holder)."<BR><BR>");

					for($j=0;$j<sizeof($pic_holder);$j++)

						{

							//echo("663 - sizeof pic_holder[".$j."] = ".sizeof($pic_holder[$j])."<BR><BR>");

							for($k=0;$k<sizeof($pic_holder[$j]);$k++)

								{

									//echo("666 - pic_holder[".$j."][".$k."] = ".$pic_holder[$j][$k]."<BR>");

									if (is_uploaded_file($_FILES[$pic_holder[$j][$k]]['tmp_name']))

										{

											$image_names[sizeof($image_names)] = basename($_FILES[$pic_holder[$j][$k]]['name']);

											if (substr($image_names[sizeof($image_names)-1],-5)==".JPEG"||substr($image_names[sizeof($image_names)-1],-5)==".jpeg")

												{

													$image_names[sizeof($image_names)-1] = substr($image_names[sizeof($image_names)-1],0,strpos($image_names[sizeof($image_name)-1],".")).".jpg";

												}

											$from = $_FILES[$pic_holder[$j][$k]]['tmp_name'];

											$to = $move_to_path."/".$_FILES[$pic_holder[$j][$k]]['name'];

											//echo("from = ".$from."<BR>to = ".$to."<BR><BR>");

											$move_success = move_uploaded_file($from,$to); 

										}

								}

						}

					//echo("650 - sizeof(pic_sizes) = ".sizeof($pic_sizes)."<BR>");

					for($i = 0;$i<sizeof($pic_sizes);$i++)

						{

	/*

							echo("679 - i = ".$i."<BR><BR>");

							echo("681 - pic_sizes[".$i."][1] = ".$pic_sizes[$i][1]."<BR>681 - pic_sizes[".$i."][2] = ".$pic_sizes[$i][2]."<BR><BR>");

							echo("682 - pic_sizes[".$i."][0] = ".$pic_sizes[$i][0]."<BR>");

	*/

							$the_path1 = $the_path.$pic_sizes[$i][0]."/".$unique_folder_name."/";

							//echo("691 - the_path1 = ".$the_path1."<BR><BR>");

							if (!(build_folder($the_path1)))

								{

									//If the folder creation was not a success

									header("Location: site_error_page?msg=Folder creation failed.  Please alert the web administrator");

								}

							else

								{	

									//echo("692 - sizeof pic_holder = ".sizeof($pic_holder)."<BR><BR>");

									//If the folder creation was a success

								}	

							if ($move_success)

								{

									//if (is_uploaded_file($_FILES[$pic_holder[$j][$k]]['tmp_name']))

									for ($j=0;$j<sizeof($image_names);$j++)

										{

											for ($k=0;$k<sizeof($pic_sizes);$k++)

												{

													$image_target_folder_path = $the_path.$pic_sizes[$k][0]."/".$unique_folder_name."/";

													//echo("719 - image_target_folder_path = ".$image_target_folder_path."<BR><BR>");

													//echo("728 -pic size for ".$pic_sizes[$k][0]." --- width = ".$pic_sizes[$k][1]." and height = ".$pic_sizes[$k][2]."<BR><BR>");

													create_image($image_names[$j],$pic_sizes[$k][1],$pic_sizes[$k][2],$move_to_path,$image_target_folder_path,$pic_sizes[$k][0]);

													//create_image($f_name,       $requested_width, $requested_height,$src_folder, $final_target_folder,      $type_of_image)

													//delete_file($to);

													$process_picture = "f";

													//echo("717 - i = ".$j."<BR>");

												}

										}

								}

						}

				}

			if ($update_set != "")	

				{

					$Thedate = Date("Y-m-d");

					$update_set	.= "date_added='$Thedate'";

					$x = 0;

					/*Open the database*/

					/*Since this is an update, DELETE these records from the appropriate table*/

					//First store this entire record in the archive database.

					//Build the archival SQL statement.......

					//$insert_SQL = "INSERT INTO $archive_db.$tablename SELECT * from $main_db.$tablename WHERE $keyfield=$keyfieldvalue;";

					//echo("insert sql - ".$insert_SQL."<BR><BR>");

					$success = mysql_query($insert_SQL);

/*		

					FORTESTING	

					success_test($success);

*/			

					//build the update SQL statement........

					$update_SQL = "UPDATE $main_db.$tablename SET $update_set WHERE $keyfield=$keyfieldvalue;";

					//echo("update sql - ".$update_SQL."<BR><BR>");

					$success = mysql_query($update_SQL);

/*

					FOR TESTING	



					success_test($success);

*/

				}

			else

				{

					$Thedate = Date("Y-m-d");

					$update_set	.= "date_added='$Thedate'";

					$x = 0;

					/*Open the database*/

					mysql_select_db($main_db, $conn_main_db);

					//Since this is an update, DELETE these records from the appropriate table

					//First store this entire record in the archive database.

					//Build the archival SQL statement.......

					//$insert_SQL = "INSERT INTO $archive_db.$tablename SELECT * from $main_db.$tablename WHERE $keyfield=$keyfieldvalue;";

					//$success = mysql_query($insert_SQL);

/*		

					FOR TESTING	

					success_test($success);

*/			

					$update_SQL = "UPDATE $main_db.$tablename SET $update_set WHERE $keyfield=$keyfieldvalue;";

					//	echo("update sql - ".$update_SQL."<BR><BR>");

				mysql_query($update_SQL);

				}

		}

	header("Location: ".$URL_path.$gotoURL."?done=done");

?>