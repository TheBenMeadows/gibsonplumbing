//_process_form.js

// JavaScript Document

/*Copyright March, 2006

This javascript file is the exclusive property of GMBCS, proprietor - Glyn Barrows.

An right to use permission is granted to Gibson Plumbing for use with the Gibson Plumbing Web Site.

*/

	form_values = new Array();

	new_values	= new Array();

	var group_id = new Array();    			//holds group id numbers only

	var group_array = new Array();			//holds number of subgroups for this grup id

	var subgroup_array = new Array();		//holds information related to the group - subgroup pairing.

	pw = new Array();

	function process_form(frm, element_id, table_name, key_field, key_field_value, gotoURL,site)

		{

			//alert("processing "+frm.name);

			//alert("element id = "+element_id);

			//alert("Site = "+site);

			//alert(frm.elements.length);

			if (element_id == "delete")

				{

					delete_this_record(frm, table_name, key_field, key_field_value, gotoURL,site);

				}

			else

				{

					//alert ("calling clean the data");

					clean_the_data(frm);

					//alert ("done Cleaning");

					result = validate_the_form(frm);

					//alert("result = "+result);

					//result= true;

					if (result)

						{

							result = find_required_groups(frm);

						}

					//alert("result = "+result);

					if (result)

						{

							count_subgroups(frm);

							count_groups(frm);

							check_subgroup_populated(frm);

							result = check_completed(frm);

						}

					//alert("result = "+result);

					if ((result)&&(element_id == "email"))

						{

							//alert("email page = "+gotoURL);

							send_message(frm,site,gotoURL);

						}

					else if ((result)&&(element_id == "update"))

						{

							//alert("going to update and first result = "+result);

							update_this_record(frm, table_name, key_field, key_field_value, element_id, gotoURL,site);

						}

					else if ((result)&&(element_id == "add"))

						{

							//alert(result);	

							add_this_record(frm, table_name, gotoURL,site);

						}

					//else if ((result)&&((element_id=="submit_contact")||(element_id=="submit_contact_gen_pub"))

					else if ((result)&&(element_id=="submit_contact" || element_id=="submit_contact_gen_pub"))

						{

							//alert("result ="+result);	

							update_this_record(frm, table_name, key_field, key_field_value, element_id, gotoURL,site);

						}

				}

		}

	function clean_the_data(frm)

		{

/*			

			alert("clean_the_data");

			//alert("number of form elements = "+frm.elements.length);

			len =frm.elements.length;

			alert("length = "+len);

			alert(form_values.length);

*/			if (form_values.length >0)

				{

					//alert("here");

					for (i=0; i<form_values.length; i++)

						{

							stng = form_values[i][0];

							stng = stng.replace(/</g,"{");

							stng = stng.replace(/>/g,"}");

							stng = stng.replace(/&/g,"and");

							stng = stng.replace(/DROP TABLE/ig, "{[-drop_table-]}");

							stng = stng.replace(/ kill/ig, "_k_i_l_l_");

							stng = stng.replace(/delete/ig, "_d_e_l_e_t_e_");

							stng = stng.replace(/mysql_drop_db /ig, "{[-mysql_drop_db-]}");

							stng = stng.replace(/drop database /ig, "{[-drop_database-]}");

							stng = stng.replace(/create database  /ig, "{[-create_database-]}");

							stng = stng.replace(/INSERT INTO  /ig, "{[-INSERT_INTO -]}");

							stng = stng.replace(/drop index/ig, "{[-drop_index-]}");

							stng = stng.replace(/drop column/ig, "{[-drop_column-]}");

							stng = stng.replace(/drop constraint/ig, "{[-drop_constraint-]}");

							stng = stng.replace(/revoke/ig, "{[-revoke-]}");

							stng = stng.replace(/&/ig, "\&");

							stng = stng.replace(/{BR}/ig,"<BR>");

							/*

							stng = stng.replace(/?/ig, "%3F");

							*/

							form_values[i][0]=stng;

						}

				}

			for (i=0; i<frm.elements.length; i++)

				{

					if ((frm.elements[i].value != " ") && (frm.elements[i].value != ""))

						{

							stng = frm.elements[i].value.replace(/</g,"{");

							stng = stng.replace(/>/g,"}");

							stng = stng.replace(/&/g,"and");

							stng = stng.replace(/=/g," equals ");

							stng = stng.replace(/DROP TABLE/ig, "{[-drop_table-]}");

							stng = stng.replace(/ kill/ig, "_k_i_l_l_");

							stng = stng.replace(/delete/ig, "_d_e_l_e_t_e_");

							stng = stng.replace(/mysql_drop_db /ig, "{[-mysql_drop_db-]}");

							stng = stng.replace(/drop database /ig, "{[-drop_database-]}");

							stng = stng.replace(/create database  /ig, "{[-create_database-]}");

							stng = stng.replace(/INSERT INTO  /ig, "{[-INSERT_INTO -]}");

							stng = stng.replace(/drop index/ig, "{[-drop_index-]}");

							stng = stng.replace(/drop column/ig, "{[-drop_column-]}");

							stng = stng.replace(/drop constraint/ig, "{[-drop_constraint-]}");

							stng = stng.replace(/revoke/ig, "{[-revoke-]}");

							stng = stng.replace(/&/ig, "\&");

							stng = stng.replace(/{BR}/ig,"<BR>");

							/*

							stng = stng.replace(/?/ig, "%3F");

							*/

							frm.elements[i].value = stng;

							stng = frm.elements[i].value;

							stng = "";

						}

				}

			msg="";	

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

				

			alert("DONE CLEANING");	

*/			return true;	

		}

	function validate_the_form(frm)

		{	

/*			alert("validate_the_data");

*/			//used for comparing password to confirmation password

			//pw = new Array();

			var stng;

			var return_value= true;

			//alert("form values length = "+form_values.length);

			if (form_values.length >0)

				{

					for (i=0; i<form_values.length; i++)

						{

							//alert("form_values[i][3] = "+form_values[i][3]);

							if ((form_values[i][3] == "password")&&(form_values[i][2] !="")&&(form_values[i][2] !=" "))

								{

									//alert("Checking Password");

									stng = form_values[i][3];

									if (stng.substr(-8,8) == "password")

										{

											pw[0] = form_values[i][2];

											pw[2] = form_values[i][4];

										}

									if (stng.substr(-7,7) == "confirm")	

										{

											pw[1] = form_values[i][2];

										}

								}

							else if (form_values[i][3] == "numeric" || form_values[i][3] == "phone" || form_values[i][3]  == "ssn")

								{

									message = form_values[i][2] ;

									//alert("The NUMERIC form element value before scrubbing = "+form_values[i][2]);

									temp = message.replace(/-/g,"");

									temp = temp.replace(/\(/g,"");

									temp = temp.replace(/\)/g,"");

									//temp = temp.replace(/\./g,"");

									if (isNaN(temp))

										{

											alert("Please enter a number only.")

											frm.form_values[i][4].style.backgroundColor='#ffff00';

											frm.form_values[i][4].focus;

											message = "";

											temp = "";

											return_value = false;

											break;

										}

									form_values[i][2] = temp;

									//alert("The NUMERIC form element value after scrubbing = "+form_values[i][2]);

									//alert("New form element value NOW")

									if (form_values[i][3] == "ssn")

										{

											if (temp > 999999999)

												{

													alert("Please enter a valid Social Security Number");

													frm.form_values[i][4].style.backgroundColor='#ffff00';

													frm.form_values[i][4].focus;

													message = "";

													temp = "";

													return_value = false;

													break;

												}

											form_values[i][2] = temp;

										}

								}

							//if (frm.elements[i].datatype == "alpha" ||frm.elements[i].datatype == "text" ||frm.elements[i].datatype == "email") && frm.elements[i].value != " " && frm.elements[i].value != "")

								//{

							if (form_values[i][3] == "email")

								{

									if (form_values[i][2].indexOf("@") != 1 && form_values[i][2].indexOf(".") == 0)

										{

											frm.elements[i].style.backgroundColor='#ffff00';

											alert("This does not appear to be a valid email address.\nPlease re-enter.");

											frm.form_values[i][4].style.backgroundColor='#ffff00';

											frm.form_values[i][4].focus;

											message = "";

											temp = "";

											return_value = false;

											break;

										}

								}

							else if (form_values[i][3] == "picture" )

								{

									temp = 	form_values[i][2];

									//alert("Picturename = "+temp);

									//alert(temp.substr(temp.indexOf('.')));

									stng = temp.substr(temp.lastIndexOf('.'));

									//stng = temp.substr(temp.indexOf('.'));

									if (stng!=".gif" && stng!=".jpg" && stng!=".JPG"&& stng!=".GIF" && stng!=".JPEG")

										{

											alert("This does not appear to be a valid Picture filename (.gif or .jpg).\nPlease re-enter.");

											frm.form_values[i][4].style.backgroundColor='#ffff00';

											frm.form_values[i][4].focus;

											message = "";

											temp = "";

											return_value = false;

											break;

										}

								}	

						}

				}

			else

				{

					for (i = 0; i < frm.elements.length;i++)

						{

							if ((frm.elements[i].type == "password")&&(frm.elements[i].value !="")&&(frm.elements[i].value !=" "))

								{

									//alert("Checking Password");

									stng = frm.elements[i].id;

									if (stng.substr(-8,8) == "password")

										{

											pw[0] = frm.elements[i].value;

											pw[2] = i;

										}

									if (stng.substr(-7,7) == "confirm")	

										{

											pw[1] = frm.elements[i].value;

										}

								}

							//alert("The -- "+frm.elements[i].name+" -- has a datatype of -- "+frm.elements[i].datatype);	

							if (frm.elements[i].datatype)

								{

									//alert("Checking Datatype which is "+frm.elements[i].datatype);

									//check phone number to make sure it is a number

									if ((frm.elements[i].datatype == "numeric" || frm.elements[i].datatype == "phone" || frm.elements[i].datatype == "ssn") && frm.elements[i].value != " " && frm.elements[i].value != "")

										{

											message = frm.elements[i].value;

											//alert("The NUMERIC form element value = "+frm.elements[i].value);

											temp = message.replace(/-/g,"");

											temp = temp.replace(/\(/g,"");

											temp = temp.replace(/\)/g,"");

											//temp = temp.replace(/\./g,"");

											if (isNaN(temp))

												{

													alert("Please enter a number only.")

													frm.elements[i].style.backgroundColor='#ffff00';

													frm.elements[i].focus;

													message = "";

													temp = "";

													return_value = false;

													break;

												}

											frm.elements[i].value = temp;

											//alert("New form element value NOW")

											if (frm.elements[i].datatype == "ssn")

												{

													if (temp > 999999999)

														{

															alert("Please enter a valid Social Security Number");

															frm.elements[i].style.backgroundColor='#ffff00';

															frm.elements[i].focus;

															message = "";

															temp = "";

															return_value = false;

															break;

														}

													frm.elements[i].value = temp;

												}

										}

									if (frm.elements[i].datatype == "email" && frm.elements[i].value != " " && frm.elements[i].value != "")

										{

											//alert("inside email  ="+frm.elements[i].value.indexOf("@")+"  and  "+frm.elements[i].value.indexOf("."));

											if (frm.elements[i].value.indexOf("@") < 1 || frm.elements[i].value.indexOf(".") < 1)

												{

													alert("The email address does not appear to be valid.\nPlease re-enter.");

													frm.elements[i].style.backgroundColor='#ffff00';

													frm.elements[i].focus;

													message = "";

													temp = "";

													return_value = false;

													break;

												}

										}

									else if (frm.elements[i].datatype == "list" && (frm.elements.value == "Not Applicable" || frm.elements.value == "NA"))

										{

											alert("This does not appear to be a selection.\nPlease re-select.");

											frm.elements[i].style.backgroundColor='#ffff00';

											frm.elements[i].focus;

											message = "";

											temp = "";

											return_value = false;

											break;

										}

									else if (frm.elements[i].datatype == "picture" )

										{

											if (!(frm.elements[i].value == "") && !(frm.elements[i].value == " "))

												{

													temp = 	frm.elements[i].value

													//alert("Picturename = "+temp);

													//alert(temp.substr(temp.indexOf('.')));

													stng = temp.substr(temp.lastIndexOf('.'));

													//alert("The original value = "+temp+"\n and the final value = "+stng);

													if (stng!=".gif" && stng!=".jpg" && stng!=".JPG"&& stng!=".GIF" && stng!=".JPEG")

														{

															alert("This does not appear to be a valid Picture filename (.gif or .jpg).\nPlease re-enter.");

															frm.elements[i].style.backgroundColor='#ffff00';

															frm.elements[i].focus;

															message = "";

															temp = "";

															return_value = false;

															break;

														}

												}

										}	

								}

						}

					//Put code HERE if there is not a 'datatype' attribute to the html form tag and there is a need to

					//to perform some check on the data.

					temp="";

					message = "";

				}

			if (pw.length>0)	

				{

					if (pw[0] != pw[1])

						{

							alert("The two password entries do not match.\nPlease re-enter...thank you");

								if (form_values.length>0)

								{

									frm.pw[2].style.backgroundColor='#ffff00';

									frm.pw[2].focus;

								}

							else

								{

									frm.elements[pw[2]].focus;

								}

							message = "";

							temp = "";

							return_value = false;

						}

				}

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert("msg");

*/				

			return return_value;	

		}

	/*

	The findsets function below is called from a click event on a button on a web page contact request form

	The only thing this does is check to insure 'required fields are populated.  Form validation does not occur

	here.

	

	For the end result to look right, the form should have a subject (perhaps one or more checkbox names),

	a form (usually a name), and one or more contact methods.  Other form elements can be present as long as they

	are set up correctly.  See the documentation in the findsets() function.

	The from must be a single textbox and it must have the html tag  NAME="from". 

	all other form elements must just be numbered correctly in the 'alt' tag.

	

	When completing the web form the following rules are used to prepare for this check.

	The 'alt' tag is used to specify the required/optional status of the particular form element

	

	THE RULES:

	Checkbox:

	Check boxes will be used to specify the subject of the contact.

	The checkbox form element must always carry an 'alt' tag of 'required_#_?'  

	The # must be a number between 1 and 9 inclusive. The question mark is one or more alpha characters.

	The alpha modifiers can be the same for all or they can be unique.  

	If the alpha modifiers are the same then all of them must be checked for the form to pass this validation.

	So, for a group of three checkboxes, if the modifiers were 1_a, 1_a, and 1_b, then either both 1_a boxes 

	must be checked or the 1_b box would have to be checked. If there was also three more check boxes in a 

	different group of checkboxes with modifiers of 2_a, 2_b, and 2_c then any one, two or three of these 

	may be checked, but at least one is required.  Population of the 1_? and the 2_? are independent of each other.

	It is felt that 9 groups of check boxes will be sufficient.

	

	Radio:

	Radio buttons are almost always in groups and must always carry an 'alt' tag of 'required_#_?'

	The # must be a number between 10 and 19 inclusive. The question mark is one or more alpha characters.

	Each group will have the same numeric modifier with each button having its unique alpha modifier.

	If a-z is not enough the start aa,ab,ac...,ba,bb,bc,...and so on.

	The grouping rules explained for checkboxes also applies.

	

	All other for elements:

	Required:

	Use 'required_#_?' for all other required elements or groups of elements.  # will begin at 20. 

	Grouping rules as explained in the checkbox above will be used.

	

	Optional:

	A form element can be declared optional three ways:

		1.  The 'alt' tag can equal 'optional'.

		2.  The 'alt' tag can be blank or anything other than 'require' or 'optional'.

		3   The 'alt' tag can be left off.

	*/

	function find_required_groups(frm)

		{

			success = true;

			//alert("find_required_groups\ngroup_id array length = "+group_id.length+"\ngroup_array length = "+group_array.length+"\nsubgroup_array length = "+subgroup_array.length);

			//build an array (group_id) with unique Numeric modifiers from the contact form

			len = frm.elements.length;

			for (i=0; i<len; i++)

				{

					//If a frm element required tag exists and is equal to one - meaning it is a required element

					//NOTE - check two possible combinations of the word 'required'

					if (((frm.elements[i].alt == "required")||(frm.elements[i].Required == "Required"))&&(success == true))

						{

							if (frm.elements[i].grouped == 1)

								{

									//Look through the group_id to determine if this group ID has already been found.

									//If it has, get the next element.  If it has not, then add this modifier to the group_id array.

									//First, set modifier equal to the group_number

									modifier = frm.elements[i].group_number;

									//Then, see if there is anything in the group_id array.

									if (group_id.length < 1) 

										{

											//if nothing in the array, then put this modifier in the zero'th element

											group_id[0] = modifier;

										}

									else 

										{

											//Determine if this is a unitque modifier by looking for it in the group_id.

											//if something is already in the array, then the next element will be the numbered 

											//element equal to the length number (because the array index is zero based)

											//Check each array element to see if it matches the current modifier.

											for (j = 0;j<group_id.length+1;j++)

												{

													if (group_id[j] == modifier)

														{

															//If it matches, break out to get the next element.

															//Set the matchit flag to 1

															matchit = 1;

														}

												}

											if (matchit == 0)	

												{

													group_id[group_id.length] = modifier;

												}

											else

												{

													matchit = 0;

												}

										}

								}

							else if (((frm.elements[i].datatype != 'checkbox')|| (frm.elements[i].datatype != 'radio')) && (frm.elements[i].value == ''))

								{

									alert ("Please enter all required information");

									frm.elements[i].style.backgroundColor='#ffff00';

									frm.elements[i].focus();

									success = false;

								}

						}

				}

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

*/				

			return success;

		}

	function count_subgroups(frm)

		{

			//Go through the element in the group_id

			//For each unique numeric modifier, get the unique alpha modifiers

			for (i=0; i<group_id.length; i++)

				{

					mod = group_id[i];

					len = frm.elements.length;

					//For each form element in the contact form

					for (j=0; j<len; j++)

						{

							//Assign the alt tag value to the stng variable

							//stng= frm.elements[j].alt;

							frm_element_name = frm.elements[j].name;

							if (frm.elements[j].group_number == mod)

								{

									if (subgroup_array.length < 1)

										{

											//Build a new array - subgroup_array - which will hold 

											//  [#][0] - group number

											//  [#][1] - subgroup number

											//  [#][2] - How many form elements have this group/subgroup combination

											//  [#][3] - populated flag (0 - no, 1 = yes)

											//  [#][4] – form element index

											subgroup_array[0] = new Array();

											subgroup_array[0][0] = mod;

											if (frm.elements[j].subgroup_number)

												{

													subgroup_array[0][1] = frm.elements[j].subgroup_number

												}

											else

												{

													subgroup_array[0][1] = 0;

												}

											subgroup_array[0][2] = 1;

											subgroup_array[0][3] = 0;

											subgroup_array[0][4] = j;

										}

									else

										{

											matchit = false;

											for (k = 0;k<subgroup_array.length;k++)

												{

													if ((subgroup_array[k][0] == frm.elements[j].group_number) && (subgroup_array[k][1] == frm.elements[j].subgroup_number))

														{

															matchit = true;

															subgroup_array[k][2]++;

														}

												}

											if (matchit == false)

												{

													idx = subgroup_array.length;

													//using the subgroup_array.length for the first index builds the next element since the length 

													//is the number of elements and the array itself is zero based.

													subgroup_array[idx] = new Array();

													subgroup_array[idx][0] = mod;

													if (frm.elements[j].subgroup_number)

														{

															subgroup_array[idx][1] = frm.elements[j].subgroup_number

														}

													else

														{

															subgroup_array[idx][1] = 0;

														}

													subgroup_array[idx][2] = 1;

													subgroup_array[idx][3] = 0;

													subgroup_array[idx][4] = j;

												}

										}

								}

						}

				}

			idx = 0;	

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

*/				

		}

	function count_groups(frm)

		{

			mod = 0;

			matchit = false;

			for (i = 0; i < subgroup_array.length;i++)

				{

					if (group_array.length <1)

						{

							group_array[0] = new Array();

							group_array[0][0]= subgroup_array[i][0];

							group_array[0][1]= 1;		//The count 

						}

					else

						{

							for (k=0;k<group_array.length;k++)

								{

									if (subgroup_array[i][0] == group_array[k][0])

										{

											matchit = true;

											group_array[k][1]++;

										}

								}

							if (matchit == false)

								{

									idx = group_array.length;

									group_array[idx] = new Array();

									group_array[idx][0]= subgroup_array[i][0];

									group_array[idx][1]= 1;		//The count 

								}

							else

								{

									matchit = false;

								}

						}

				}

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

*/				

		}

	function check_subgroup_populated(frm)

		{

			for (i=0;i<group_array.length;i++)

				{

					for (j=0;j<subgroup_array.length;j++)

						{

							for (k=0;k<frm.elements.length;k++)

								{

									if ((subgroup_array[j][0] == frm.elements[k].group_number)&&(subgroup_array[j][1] == frm.elements[k].subgroup_number))

										{

											//Is it a checkbox or radio button?

											if ((frm.elements[k].type == 'checkbox') || (frm.elements[k].type == 'radio'))

												{

													//Is it checked?

													if (frm.elements[k].checked)

														{

															//Checked = yes

															subgroup_array[j][3] = 1;

															//Since only one of the group must be checked then don’t bother with the rest of these

															break;

														}

													else

														{

															//checked = no

															subgroup_array[j][3] = 0;

														}

												}

											else 

												{

													//If not a checkbox or radio button, then is it populated (not blank)

													if (frm.elements[k].value != '')

														{

															//populated

															subgroup_array[j][3] = 1;

														}

													else

														{

															//not populated

															subgroup_array[j][3] = 0;

															//since this condition fails the populated test move on to the next Subgroup_array element

															break;

														}

												}

										}

								}

						}

				}

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

*/				

		}

	function check_completed(frm)

		{

			success = true;

			for (i = 0;i<group_array.length;i++)

				{

					counter1 = group_array[i][1];

					for (j=0;j<subgroup_array.length;j++)

						{

							if (group_array[i][0] == subgroup_array[j][0])

								{

									populated = false;

									if (subgroup_array[j][3] == 1)

										{

											populated = true;

										}

									else

										{

											counter1--;

										}

									if (counter1 == 0)

										{

											if (populated ==false)

												{

													alert ("Please enter all required information/nform element = "+frm.elements[subgroup_array[j][4]].name);

													frm.elements[subgroup_array[j][4]].style.backgroundColor='#ffff00';

													frm.elements[subgroup_array[j][4]].focus();

													success = false;

													group_id = new Array();    			//holds group id numbers only

													group_array = new Array();			//holds number of subgroups for this group id

													subgroup_array = new Array();		//holds information related to the group - subgroup pairing.

													message = "";						//Holder for a message of some kind

													break;

												}

										}

								}

						}

				}

/*			

			for (i=0; i<frm.elements.length; i++)

				{

						msg+=frm.elements[i].name+" = "+frm.elements[i].value+"\n";

				}

			alert	(msg);

*/				

			return success;	

		}

	function reset_form_fields(frm)

		{

			for (i=0; i<frm.elements.length; i++)

				{

					frm.elements[i].value = "";

				}

		}

	function check_the_data(obj,id)

		{

			//NOTE: THis function currently handles only the addition of a guest comment

			var action_clause;

			action_clause="_php_files/add_record_generic.php?table_name=guest_comments&";

			for (i=0; i<obj.elements.length; i++)

				{

					if (obj.elements[i].name == "guest_comments")

						{

							if ((obj.elements[i].value == "") || (obj.elements[i].value == " "))

								{

									alert("Please enter your message before submitting.");

									action_clause = 'bad';

									obj.element.focus;

									break;

								}

							else

								{

									action_clause+=obj.elements[i].name +"="+obj.elements[i].value+"&"; 

								}

						}

					else

						{

							action_clause+=obj.elements[i].name +"="+obj.elements[i].value+"&"; 

						}

				}

			if (action_clause !='bad')

				{

					if (id == 'registered_guest')

						{

							action_clause += "gotoURL=../guest_comment_center.php";

						}

					else //general public comment

						{

							action_clause += "gotoURL=../guestcenter.php";

						}

/*

					alert("Checking data");

					alert("action clause = "+action_clause);

	*/

					obj.action = action_clause;

					obj.submit();		

				}

		}

	function load_new_values(frm,element_name,old_value,datatype,id,new_value)

		{

			var z;//+element_name+"\nold_value = "+old_value+"\n new_value = "+new_value

			//alert("Old value = "+old_value+"\nNew value = "+new_value);

			if (form_values.length == 0)

				{

					z=0;

				}

			else

				{

					z = form_values.length;

				}

			//alert("array = "+z);

			form_values[z] = new Array();

			form_values[z][0] = element_name;

			form_values[z][1] = old_value;

			form_values[z][2] = new_value;

			form_values[z][3] = datatype;

			form_values[z][4] = id;

			form_values[z][5] = "changed_"+element_name;

			//alert("form_values[#][5] = "+form_values[z][5]);

		}

	/**/

	function getform(frm,elementValue)

		{

	

/*			alert ("get form");*/





			table_name = elementValue.substring(elementValue.indexOf('_')+1);

			action_name = elementValue.substring(0,elementValue.indexOf('_'));

			page_info = 'action_name='+action_name+'&table_name='+table_name;

			//alert ("page info = "+page_info);

			//alert ("Action name = "+action_name);

			//***** CHANGE ***** CHANGE ***** CHANGE ***** CHANGE ****

			//Advise changing folder names in following if..else if statements

			

			for (i=0;i<frm.elements.length;i++)

				{

					id =frm.elements[i].id;

					if (frm.elements[i].name == "quantity")

						{

							

						}

				}

			if (action_name == 'add')

				{

					stng1 = elementValue.substring(elementValue.lastIndexOf('_')+1)

					for (i=0; i<frm.elements.length; i++)

						{

							id =frm.elements[i].id;

							//alert (id.substr(9));

							if ((id.substr(0,8)=='quantity') && (elementValue.substr(4)==id.substr(9)))

								{

									page_info+="&quantity="+frm.elements[i].value;

								}

						}

					window.location="../_php_files/manage_database.php?" + page_info;

				}

			else if ((action_name == 'change')|| (action_name == 'approve')|| (action_name == 'close'))

				{

							window.location="../_php_files/get_record_page.php?" + page_info;

				}

			else if (action_name == 'build')

				{

					window.location="../_php_files/build_something.php?" + page_info;

				}

			else if (action_name == 'send')

				{

					//window.location="../_php_files/add_to_database_page.php?" + page_info;

					window.location="../_php_files/send_something.php?" + page_info;

				}

		}		