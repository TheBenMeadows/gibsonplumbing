<?php

	//general_functions.php

	function get_path($site,$main_db,$conn_main_db,$tablename,$pic_cat)

		{

			//For this function to work there must be two tables in the database.

			//One called picture_category which will describe the various picture categories and

			//the othere called pic_sizes which will hold the various size dimensions of the pictures for a

			//specific category.

			//picture_category fields;

			//		-  id_number

			//		-  category

			//		-  description

			//		-  data_added

			//

			//pic_sizes fields;

			//		-  id_number

			//		-  pic_designation

			//		-  width

			//		-  height

			if ($site == "admin")

				{

					$path = "../";

				}

			else

				{

					$path == "";

				}

			mysql_select_db($main_db, $conn_main_db);

			$schema_query = "SELECT * FROM db_schema WHERE table_name = '".$tablename."';";

			$rs_gp_schema = mysql_query($schema_query, $conn_main_db) or die(mysql_error()); 

			$row_rs_gp_schema = mysql_fetch_assoc($rs_gp_schema);

			$totalRows_rs_gp_schema = mysql_num_rows($rs_gp_schema);

			$main_table_query = "SELECT * FROM ".$tablename.";";

			$rs_main_table = mysql_query($main_table_query , $conn_main_db) or die(mysql_error()); 

			$row_rs_main_table = mysql_fetch_assoc($rs_main_table);

			$totalRows_rs_main_table = mysql_num_rows($rs_main_table);	



			for ($i = 0;$i<$totalRows_rs_schema;$i++)

				{

					if ($row_rs_schema['field_type'] == "picture")

						{

							$main_folder = $row_rs_schema['item_folder']."/";

						}

					if ($pic_cat == NULL)	

						{

							//This condition may exist when trying to locate existing pictures.

						}

					else

						{

							$cat_id = $pic_cat;

						}

					if ($row_rs_schema['xref_table'] == "picture_category")

						{

							$select_cat_SQL = "SELECT * FROM picture_category WHERE id_number = ".$pic_cat.";";

			//echo("HERE1= ".$select_cat_SQL."<BR>");

							$rs_cat_table = mysql_query($select_cat_SQL , $conn_main_db) or die(mysql_error()); 

							$row_rs_cat_table = mysql_fetch_assoc($rs_cat_table);

							$totalRows_rs_cat_table = mysql_num_rows($rs_cat_table);

							$cat_folder = $row_rs_cat_table['category']."/";

							mysql_free_result($rs_cat_table);

						}

					else

						{

							$cat_folder = "";

						}

					$row_rs_schema = mysql_fetch_assoc($rs_schema);

				}

			if (isset($cat_id))

				{

					$select_cat_size_SQL = "SELECT * FROM pic_sizes WHERE pic_category = ".$cat_id.";";

					$rs_cat_size = mysql_query($select_cat_size_SQL , $conn_main_db) or die(mysql_error()); 

					$row_rs_cat_size = mysql_fetch_assoc($rs_cat_size);

					$totalRows_rs_cat_size = mysql_num_rows($rs_cat_size);

					for ($i=0;$i<$totalRows_rs_cat_size;$i++)

						{

							$cat_size_array[$i][0] = $row_rs_cat_size['pic_designation'];

							$cat_size_array[$i][1] = $row_rs_cat_size['width'];

							$cat_size_array[$i][2] = $row_rs_cat_size['height'];

							$row_rs_cat_size = mysql_fetch_assoc($rs_cat_size);

						}

					mysql_free_result($rs_cat_size);

				}	

			mysql_free_result($rs_schema);

			mysql_free_result($rs_main_table);

			$basic_path_array[0] = $path.$main_folder.$cat_folder;

			if (isset($cat_size_array))

				$basic_path_array[1] = $cat_size_array;

			return $basic_path_array;

		}

	function get_height($data)  

		{

			//This gets the height of several lines of text based on the algorythm...

			$message = $data;

			$len = strlen($message);

			$rem = $len % 80;

			$lines = ceil($len/80);

			//$lines = (($len)-$rem) / 80;

			$lines1 = $lines;

			$height = $lines1 * 13.85;

			return $height;

		}

	function send_mail()

		{		

			$message = "";

			$Thedate = Date("Y-m-d");

			$x = 0;

			$GoToURL = "../contact_form.php";

			$numargs = func_num_args();

			echo "Number of arguments: $numargs<br />\n";

			if ($numargs >= 2) 

				{

					echo "Second argument is: " . func_get_arg(1) . "<br />\n";

				}

			$arg_list = func_get_args();

			for ($i = 0; $i < $numargs; $i++) 

				{

					echo "Argument $i is: " . $arg_list[$i] . "<br />\n";

				}

			foreach($_GET as $name=>$value )

				{

						switch ($name) 

							{

								case "subject":

									$subj = $value;

									break;    

								case "from":

									$from = $value;

									break;

								case "email":

									$to = $value;

									break;	    

								case "message":

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

								case "mail_code":

									$mc = $value;

									break;

								case "type":

									//Type represents the type of request.  This is used to determine who gets the message 

									$type = $value;	

									break;

							}

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

			//If the requestor's address is neither null nor blank (space) add the email to the message

				}		

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

			if ($subj == "site")

				{

					$whoto = "gbarrows@gmbcs.com,info@gmbcs.com";

				}

			else if ($subj == "hosting")

				{

					$whoto = "info@gmbcs.com";

				}

			else if ($subj == "graphics")

				{

					$whoto = "info@gmbcs.com";

				}	

			else if ($subj != "" && $subj != " ")

				{

					$whoto = "info@gmbcs.com";

				}

			/*

			for testing

			echo ("mail (".$whoto.",".$subj.",".$message.")");

			*/

			//remove above statement and UNCOMMENT the two statements below when ready to test on line tested

			mail ($whoto, $subj, $message);	

			return true;

		}

	function logout($goto)

		{

			// Unset session data

			$_SESSION=array();

			// Clear cookie

			unset($_COOKIE[session_name()]);

			// Destroy session data

			session_destroy();

			// Redirect to clear the cookie.

			$time=time();

			return $goto;

			exit;

		}

	function delete_file($filename)

		{

			chmod($filename, 0777); 

			if(unlink($filename)) 

				{ 

					return true; 

				} 

			else 

				{ 

					return false; 

				}

		}

	function success_test($success)

		{

				if ($success)

					{

						echo("successful<BR><BR>");

					}

				else

					{

						echo("UN successful<BR>". mysql_error()."<BR><BR>") ;

					}		

		}

	/*The following function cleans up the text string in the $theValue variable*/

	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

		{

			$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

			switch ($theType) 

				{

					case "string":

						$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

						break;    

					case "text":

						$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

						break;    

					case "long":

					case "int":

						$theValue = ($theValue != "") ? intval($theValue) : "NULL";

						break;

					case "double":

						$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";

						break;

					case "date":

						$theValue = ($theValue != "") ? "'" . date("Y-d-m",strtotime($theValue)) . "'" : "NULL";

						break;

					case "time":

						$theValue = ($theValue != "") ? "'" . date("H:i:s",strtotime($theValue)) . "'" : "NULL";

						break;

					case "datetime":

						$theValue = ($theValue != "") ? "'" . date("Y-d-m H:i:s",strtotime($theValue)) . "'" : "NULL";

						break;

					case "defined":

						$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

						break;

				}

			return $theValue;

		}

	function parse_feet($data)  

		{

			//This functiion assumes that the date retrieved from the database will be in the format yyyy-mm-dd-

			if (!(isset($data)))

				{

					$data_feet[0] = 0;

					$data_feet[1] = 0;

				}

			else

				{	

					$data_temp = explode("\"",$data);

					$data_feet = explode("'",$data_temp[0]);

				}

			return $data_feet;

		}

	function locate_image($file_name,$site,$main_db,$conn_main_db,$tablename,$pic_cat,$unique_folder_name)

		{

			$val = 1;

			$path_array = get_path($site,$main_db,$conn_main_db,$tablename,$pic_cat);

			$pic_size_array = $path_array[1];

			for ($i=0;$i<sizeof($pic_size_array);$i++)

				{

					$t_path = $path_array[0].$pic_size_array[$i][0]."/".$unique_folder_name;

					$t_file = $t_path."/".$file_name;

					if (!file_exists($t_path))

						{

							//The first step is to do a little cleanup.  

							//Determine if the folder exists.  If it doesn't, then create it.

							//Since we had to create the folder, the file itself cannot exist, so set val to false - "0"

							$success = build_folder($t_path);

						}

					if (!file_exists($t_file))

						{

							$val = 0;

						}

				}

			//If val is set to zero, we can by pass the following and return the false state.

			//	If val is still 1 (not zero), then we need to see of the file_name exists. in theat folder.

			return $val;

		}

	function build_folder($the_path)

		{

			if (sizeof($the_path) > 0)

				{

					for ($i = 0;$i<sizeof($the_path);$i++)

						{

							$temp_dir = explode("/",$the_path);

							$the_dir = "";

							for ($j=0;$j<sizeof($temp_dir);$j++)

								{

									$the_dir .=$temp_dir[$j]."/";

									if (!file_exists($the_dir))

										{

											$success = mkdir ($the_dir, 0777);

										}

									else

										{

											$success = true;

										}

								}

						}

				}

			else if	(sizeof($the_path) == 0)

				{

					$success = false;

				}

			return $success;

		}

	function get_pic_elements($rs_pic_size,$row_rs_pic_size,$totalRows_rs_pic_size)

		{

			for ($i=0;$i<$totalRows_rs_pic_size;$i++)

				{

					$sizes_array[$i][0] = $row_rs_pic_size['pic_designation'];

					$sizes_array[$i][1] = $row_rs_pic_size['width'];

					$sizes_array[$i][2] = $row_rs_pic_size['height'];

					$row_rs_pic_size = mysql_fetch_assoc($rs_pic_size);

				}

			return $sizes_array;

		}	

	function get_path_categories($record_set)

		{

			$temp_path = array();

			mysql_data_seek($record_set, 0);

			if (mysql_num_rows($record_set) > 0)

				{

					$row_record_set = mysql_fetch_assoc($record_set);

					$temp_path[0] = $row_record_set['pic_category'];

					for ($i = 1;$i<mysql_num_rows($record_set);$i++)

						{

							$row_record_set = mysql_fetch_assoc($record_set);

							if (!($temp_path[sizeof($temp+path)-1] == $row_record_set['pic_category']))

								{

									$temp_path[sizeof($temp+path)] == $row_record_set['pic_category'];

								}

						}

				}

			return $temp_path;

		}

	function get_image_path($row_rs_schema,$rs_schema2,$temp_path,$pic_cat,$main_db, $conn_main_db)

		{

			mysql_select_db($main_db, $conn_main_db);

			if (!($row_rs_schema['item_folder'] == "")&&!($row_rs_schema['item_folder']==" "))

				{

					$base_folder = $temp_path.$row_rs_schema['item_folder'];

				}

			else

				{

					$base_folder = $temp_path."site_images";

				}

			$the_folder = $base_folder."/";

			$tmp_folder_name = $row_rs_schema['dynamic_folder_name'];

			$field_stuff = explode(",",$tmp_folder_name);

			if (($row_rs_schema['dynamic_folder_table'] == "this")||($row_rs_schema['dynamic_folder_table'] == "This"))

				{

					if (sizeof($field_stuff) > 0)

						{

							//Concatenate the values	

							for ($i = 0;$i<sizeof($field_stuff);$i++)

								{

									if (isset($_POST[$field_stuff[$i]]))

										{

											$sub_folder .= $_POST[$field_stuff[$i]];

										}

									else if (isset($_GET[$field_stuff[$i]]))

										{

											$sub_folder .= $_GET[$field_stuff[$i]];

										}

								}

						}			

					else	

						{

							exit("There is a problem loading the image(s).  A Stock Number is required. <BR>error - img902<BR>Please contact web support!");

						}

				}

			else

				{

					$src_table = $row_rs_schema['dynamic_folder_table'];

					if (!($src_table == "") && !($src_table == " "))

						{

							$row_rs_schema2 = mysql_fetch_assoc($rs_schema2);

							$totalRows_rs_schema2 = mysql_num_rows($rs_schema2);

							do

								{

									//find the first record that has the $src_table in the xref_table field

									if (($row_rs_schema2['field_type'] == "list") && ($row_rs_schema2['xref_table'] == $src_table))

										{

											//Once found set a variable $id equal to the passed in value

											if (isset($_POST[$row_rs_schema2['field_name']]))

												{

													$id = $_POST[$row_rs_schema2['field_name']];

												}

											elseif (isset($_GET[$row_rs_schema2['field_name']]))

												{

													$id = $_GET[$row_rs_schema2['field_name']];

												}

											else

												{

													exit("There is a problem loading the image(s) error - img901<BR>Please contact web support!");

												}

											//Using the $id value select the record from the appropriate table 

											$select_SQL = "SELECT * FROM ".$src_table." WHERE id_number = ".$id.";";

											$rs_temp = mysql_query($select_SQL, $conn_main_db) or die(mysql_error()); 

											$row_rs_temp = mysql_fetch_assoc($rs_temp);

											$totalRows_rs_temp = mysql_num_rows($rs_temp);

											if (sizeof($field_stuff) > 1)

												{

													$sub_folder = $row_rs_temp[$field_stuff[0]];

													//Concatenate the values	

													for ($i = 1;$i<sizeof($field_stuff);$i++)

														{

															$sub_folder .= $row_rs_temp[$field_stuff[$i]];

														}

												}

											else

												{

													$sub_folder = $row_rs_temp[$tmp_folder_name];

												}

										}

									if ($totalRows_temp > 1)

										{

											exit("There is a problem loading the image(s) error - img902<BR>Please contact web support!");

										}

								}

							while ($row_rs_schema2 = mysql_fetch_assoc($rs_schema2));

						}

				}

			$the_folder .= $sub_folder."/";

			if (isset($pic_cat))

				{

					$select_cat_SQL = "SELECT category FROM picture_category WHERE id_number = '".$pic_cat."';";

					$rs_pic_cat = mysql_query($select_cat_SQL, $conn_main_db) or die(mysql_error()); 

					$row_rs_pic_cat = mysql_fetch_assoc($rs_pic_cat);

					$pic_folder = $row_rs_pic_cat['category'];

					$totalRows_rs_pic_cat = mysql_num_rows($rs_pic_cat);

					$select_SQL = "SELECT * FROM pic_sizes WHERE pic_category = '".$pic_cat."';";

					$rs_pic_size = mysql_query($select_SQL, $conn_main_db) or die(mysql_error()); 

					$row_rs_pic_size = mysql_fetch_assoc($rs_pic_size);

					$totalRows_rs_pic_size = mysql_num_rows($rs_pic_size);

				}

			else

				{

					return "error pic_cat";

					break;

				}

			$the_folder .= $pic_folder."/";

			$pic_sizes = get_pic_elements($rs_pic_size,$row_rs_pic_size,$totalRows_rs_pic_size);

			$the_path = array();

			for ($j=0;$j<sizeof($pic_sizes);$j++)

				{

					$the_path[sizeof($the_path)] = $the_folder.$pic_sizes[$j][0]."/";

				}

			$path_and_pic_elements[0] = $the_path;

			$path_and_pic_elements[1] = $pic_sizes;

			return $path_and_pic_elements;

		}

	function build_folder_alternate($folder_name,$l_name, $f_name,$the_path)

		{

			$i = 0;  //tests for the while

			$j=0;	//increments for naming the folder

			if ($folder_name == "NONE")

				{

					$folder_name=$l_name.substr($f_name,0,1)."/";

					$dir_name = $the_path.$folder_name;

					do 

						{

							if (!file_exists($dir_name))

								{

									$i++;

									mkdir ($dir_name, 0755);

									mkdir ($dir_name."thumb", 0755);

									mkdir ($dir_name."regular", 0755);

								}

							else

								{

									if(!file_exists($dir_name."thumb"))

										{

											mkdir ($dir_name."thumb", 0755);

										}

									if(!file_exists($dir_name."regular"))

										{

											mkdir ($dir_name."regular", 0755);

										}

									$j++;	

								}

							$folder_name=$l_name.substr($f_name,0,1)."_".$j;

							$dir_name = $the_path.$folder_name;

						}

					while ($i<1);

					$i = 0;  //tests for the while

					$j=0;	//increments for naming the folder

				}

			else //got a name from the database

				{

					$folder_name = $folder_name."/";

					$dir_name = $the_path.$folder_name;

					if (!file_exists($dir_name))

						{

							$i++;

							mkdir ($dir_name, 0755);

							mkdir ($dir_name."thumb", 0755);

							mkdir ($dir_name."regular", 0755);

						}

					else

						{

							if(!file_exists($dir_name."thumb"))

								{

									$success = mkdir ($dir_name."thumb", 0755);

								}

							if(!file_exists($dir_name."regular"))

								{

									mkdir ($dir_name."regular", 0755);

								}

						}

					$i = 0;  //tests for the while

					$j=0;	//increments for naming the folder

				}

			return $folder_name;

		}

	function get_unique_folder($row_rs_temp_schema,$totalRows_rs_temp_schema,$rs_temp_schema,$main_db,$conn_main_db,$tablename,$keyfieldvalue)

		{

			mysql_select_db($main_db, $conn_main_db);

			for ($i = 0;$i<$totalRows_rs_temp_schema;$i++)

				{

					if ($row_rs_temp_schema['field_type'] == "picture")

						{

							//The particular record being looked at in the schema table is for a specifi table and field. 

							//This record holds the name of a file in a folder on the host.

							//The name for this folder is taken from dynamic folder name field.  One or more field names

							//will be in this field (separated by commasif more than one).

							//For example, using a persons name, it may be desired to use the lastname and the firstname 

							//of an employee.  Assume an employee table where tow of its fields are f_name and l_name.

							//Further, the data taken from these two fields will be used to create a "unique/dynamic" folder name

							//These fields would then be in the dynamic folder name field like this:

							//l_name,f_name. 

							$dyn_fldr_nme = $row_rs_temp_schema['dynamic_folder_name'];

							//Explode this data to see if there is more than one item in this field.

							$field_stuff = explode(",",$row_rs_temp_schema['dynamic_folder_name']);

							$field_table = $row_rs_temp_schema['dynamic_folder_table'];

						}

					$row_rs_temp_schema = mysql_fetch_assoc($rs_temp_schema);	

				}

			//if there is more than one element in the fieldstuff array, then the unique picture foldername will 

			//contain a concatenated version of the contents of the field.

			//In this add record script, this information will be set in the passed-in POST or GET variables

			$unique_folder_name = "";

			for ($i=0;$i<sizeof($field_stuff);$i++)

				{

					if (isset($_POST[$field_stuff[$i]]))

						{

							$unique_folder_name .= $_POST[$field_stuff[$i]];

						}

					else if(isset($_GET[$field_stuff[$i]]))

						{

							$unique_folder_name .= $_GET[$field_stuff[$i]];

						}

					else if(!($field_table=="")&&!($field_table==" ")&&!($field_table==NULL))

						{

							if (!($field_table == "this")&&!($field_table == "This"))

								{

									mysql_data_seek($rs_temp_schema, 0);

									$row_rs_temp_schema = mysql_fetch_assoc($rs_temp_schema);

									for ($i = 0;$i<$totalRows_rs_temp_schema;$i++)

										{

											if ($row_rs_temp_schema['xref_record_field'] == $dyn_fldr_nme)

												{

													//echo("dyn fldr nme = ".$dyn_fldr_nme."<BR>");

													if (isset($_POST[$row_rs_temp_schema['field_name']]))

														{

															$id = $_POST[$row_rs_temp_schema['field_name']];

														}

													else if (isset($_GET[$row_rs_temp_schema['field_name']]))

														{

															$id = $_GET[$row_rs_temp_schema['field_name']];

														}

													else

														{

															$temp_query = "SELECT * FROM ".$tablename." WHERE id_number = ".$keyfieldvalue.";";

															$rs_temp = mysql_query($temp_query, $conn_main_db);

															$row_rs_temp = mysql_fetch_assoc($rs_temp);

															$id = $row_rs_temp[$row_rs_temp_schema['field_name']];

														}

													$select_SQL = "SELECT * FROM ".$row_rs_temp_schema['xref_table']." WHERE id_number = ".$id.";";

													//echo("the select statement = ".$select_SQL."<BR>");

													$rs_unique = mysql_query($select_SQL, $conn_main_db) or die(mysql_error()); 

													$row_rs_unique = mysql_fetch_assoc($rs_unique);

													$totalRows_rs_unique = mysql_num_rows($rs_unique);

												}

											$row_rs_temp_schema = mysql_fetch_assoc($rs_temp_schema);

										}

									for ($i=0;$i<sizeof($field_stuff);$i++)

										{

											$unique_folder_name .= $row_rs_unique[$field_stuff[$i]];

										} 

								}

							else

								{

									if (isset($_POST['key_field_value']))

										{

											$field_value = $_POST['key_field_value'];

										}

									else if (isset($_GET['key_field_value']))

										{

											$field_value = $_GET['key_field_value'];

										}

									else

										{

											$field_value = 1;	

										}

									$select_SQL = "SELECT * FROM ".$tablename." WHERE id_number = ".$field_value.";";

									$rs_unique = mysql_query($select_SQL, $conn_main_db) or die(mysql_error()); 

									$row_rs_unique = mysql_fetch_assoc($rs_unique);

									$totalRows_rs_unique = mysql_num_rows($rs_unique);

									$unique_folder_name .= $row_rs_unique[$field_stuff[$i]];

								}	

						}

				}

			//echo("field_table = ".$unique_folder_name."<BR><BR>");

			return $unique_folder_name;

		}

	function find_browser($useragent)

		{

			//The call for this is something like 

			//		$browser = find_browser($_SERVER['HTTP_USER_AGENT']);

			//check for most popular browsers first

			//unfortunately that's ie. We also ignore opera and netscape 8 

			//because they sometimes send msie agent

			if(strpos($useragent,"MSIE") !== false && strpos($useragent,"Opera") === false && strpos($useragent,"Netscape") === false)

				{

					//deal with IE

					$found = preg_match("/MSIE ([0-9]{1}\.[0-9]{1,2})/",$useragent,$mathes);

					if($found)

						{

							return "IE".$mathes[1];

							//return "Internet Explorer " . $mathes[1];

						}

				}

			elseif(strpos($useragent,"Gecko"))

				{

					//deal with Gecko based

					//if firefox

					//$found = preg_match("/Firefox\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					//if($found)

					if(preg_match("/Firefox\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "Moz_".$mathes[1];

							//return "Mozilla Firefox " . $mathes[1];

						}

					//if Netscape (based on gecko)

					//$found = preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					//if($found)

					else if (preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "NS_".$mathes[1];

							//return "Netscape " . $mathes[1];

						}

					//if Safari (based on gecko)

					//$found = preg_match("/Safari\/([0-9]{2,3}(\.[0-9])?)/",$useragent,$mathes);

					else if(preg_match("/Safari\/([0-9]{2,3}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "Saf_".$mathes[1];

							//return "Safari " . $mathes[1];

						}

					//if Galeon (based on gecko)

					//$found = preg_match("/Galeon\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					else if(preg_match("/Galeon\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "Gal_".$mathes[1];

							//return "Galeon " . $mathes[1];

						}

					

					//if Konqueror (based on gecko)

					//$found = preg_match("/Konqueror\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					else if(preg_match("/Konqueror\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "Kon_".$mathes[1];

							//return "Konqueror " . $mathes[1];

						}

					else

						{

							//no specific Gecko found

							//return generic Gecko

							return "Gecko based";

						}

				}

			elseif(strpos($useragent,"Opera") !== false)

				{

					//deal with Opera

					//$found = preg_match("/Opera[\/ ]([0-9]{1}\.[0-9]{1}([0-9])?)/",$useragent,$mathes);

					if(preg_match("/Opera[\/ ]([0-9]{1}\.[0-9]{1}([0-9])?)/",$useragent,$mathes))

						{

							return "Op_".$mathes[1];

							//return "Opera " . $mathes[1];

						}

				}

			elseif (strpos($useragent,"Lynx") !== false)

				{

					//deal with Lynx

					//$found = preg_match("/Lynx\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					if(preg_match("/Lynx\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							return "Lynx_".$mathes[1];

						}

				}

			elseif (strpos($useragent,"Netscape") !== false)

				{

					//NN8 with IE string

					//$found = preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes);

					if(preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$useragent,$mathes))

						{

							//return "IE".$mathes[1];

							return "Ns_".$mathes[1];

						}

				}

			else 

				{

					//unrecognized, this should be less than 1% of browsers (not counting bots like google etc)!

					return false;

				}

		}

		/**

		 * Get browsername and version

		 * @param string user agent	 

		 * @return string os name and version or false in unrecognized os

		 * @static 

		 * @access public

		 */

	function get_os($useragent)

		{		

			//the call for this is something like

			//		$os = get_os($_SERVER['HTTP_USER_AGENT']);

			$useragent = strtolower($useragent);

			//check for (aaargh) most popular first		

			//winxp

			if(strpos("$useragent","windows nt 5.1") !== false)

				{

					return "Windows XP";			

				}

			elseif (strpos("$useragent","windows 98") !== false)

				{

					return "Windows 98";

				}

			elseif (strpos("$useragent","windows nt 5.0") !== false)

				{

					return "Windows 2000";

				}

			elseif (strpos("$useragent","windows nt 5.2") !== false)

				{

					return "Windows 2003 server";

				}

			elseif (strpos("$useragent","windows nt 6.0") !== false)

				{

					return "Windows Vista";

				}

			elseif (strpos("$useragent","windows nt") !== false)

				{

					return "Windows NT";

				}

			elseif (strpos("$useragent","win 9x 4.90") !== false && strpos("$useragent","win me"))

				{

					return "Windows ME";

				}

			elseif (strpos("$useragent","win ce") !== false)

				{

					return "Windows CE";

				}

			elseif (strpos("$useragent","win 9x 4.90") !== false)

				{

					return "Windows ME";

				}

			elseif (strpos("$useragent","mac os x") !== false)

				{

					return "Mac OS X";

				}

			elseif (strpos("$useragent","macintosh") !== false)

				{

					return "Macintosh";

				}

			elseif (strpos("$useragent","linux") !== false)

				{

					return "Linux";

				}

			elseif (strpos("$useragent","freebsd") !== false)

				{

					return "Free BSD";

				}

			elseif (strpos("$useragent","symbian") !== false)

				{

					return "Symbian";

				}

			else 

				{

					return false;

				}

		}

	function insertSecurityImage() 

		{

			$refid = md5(mktime()*rand());

			$insertstr = "<img src=\"secure_image.php?refid=".$refid."\" alt=\"Security Image\">\n

			<input type=\"hidden\" name=\"".$inputname."\" value=\"".$refid."\">";

			return $refid;

			//echo($insertstr);

		}

	

	//Define function to check security image confirmation

	function checkSecurityImage($referenceid, $enteredvalue) 

		{

			$referenceid = mysql_escape_string($referenceid);

			$enteredvalue = mysql_escape_string($enteredvalue);

			$tempQuery = mysql_query("SELECT id_number FROM security WHERE referenceid='".$referenceid."' AND hiddentext='".$enteredvalue."'");

			if (mysql_num_rows($tempQuery)!=0) 

				{

					return true;

				} 

			else 

				{

					return false;

				}

		}

?>