	//_form_actions.js
// JavaScript Document
/*Copyright March, 2006
This javascript file is the exclusive property of GMBCS, proprietor - Glyn Barrows.
An right to use permission is granted to Gibson Plumbing for use with the Gibson Plumbing Web Site.
*/
	function add_this_record(frm, table_name, gotoURL,site)
		{
			//alert("add this record");
			//alert("SITE + "+site);
			if (site =='main')
				{
					URL_String = "_php_files/add_record_generic.php?TypeUpdate=add&gotoURL=../"+gotoURL+"&table_name="+table_name+"&site="+site;
				}
			else if (site == 'admin')
				{
					URL_String = "../_php_files/add_record_generic.php?TypeUpdate=add&gotoURL="+gotoURL+"&table_name="+table_name+"&site="+site;
				}
/*
				alert("the URL String = "+URL_String);
				alert("number of elements = "+frm.elements.length);
*/
			j=0;
			for (i = 0;i<frm.elements.length;i++)
				{
					if ((frm.elements[i].type == "file") && (frm.elements[i].value != ""))
						{
							//add the name of the file input box to the string  "box_name".
							URL_String += "&box_name_"+j+"="+frm.elements[i].name;
							//alert("Found a file box and the URL String = \n"+URL_String);
							j++;
						}
				}

			frm.action = URL_String;
			for (i = 0;i<frm.elements.length;i++)
				{
					if ((frm.elements[i].type == "checkbox")||(frm.elements[i].type == "radio"))
						{
							//if it is checked
							if (frm.elements[i].checked)
								{
									URL_String += "&"+frm.elements[i].name+"=t";
								}
							//if it is not checked	
							else 
								{
									URL_String += "&"+ frm.elements[i].name+"=f";
								}
						}
/*
					else if ((frm.elements[i].type == "list" )&& ((frm.elements[i].id == "month") || (frm.elements[i].id == "day") || (frm.elements[i].id == "year")))
						{
							//alert("It is a list");+"_"+frm.elements[i].id
							URL_String += "&"+frm.elements[i].name+"="+frm.elements[i].value;
						}
					else if ((frm.elements[i].id == "feet") || (frm.elements[i].id == "inches"))
						{
							//alert("It is a list");+"_"+frm.elements[i].id
							URL_String += "&"+frm.elements[i].name+"="+frm.elements[i].value;
						}
*/
					else if (frm.elements[i].value)
						{
							URL_String += "&"+frm.elements[i].name+"="+frm.elements[i].value;
						}
				}
			frm.action = URL_String;
			//alert (frm.action);
			//alert(URL_String);	
			//window.location = URL_String;
			frm.submit();
		}
	function delete_this_record(frm, table_name, key_field, key_field_value, gotoURL,site)
		{ 
			if (key_field_value == "")
				{
					alert("No records deleted.");
					return false;
				}
			else 
				{
					if (confirm("This will DELETE this record.  Select CANCEL to stop this action"))
						{
							URL_String	= "delete_record.php?table_name=" + table_name + "&key_field=" + key_field + "&key_field_value=" + key_field_value + "&gotoURL="+gotoURL;
							window.location=URL_String;
						}
					else 
						{
							alert("No records deleted.");
							return false;
						}	
				}
			/**/	
		}
	function update_this_record(frm, table_name, key_field, key_field_value, element_id, gotoURL,site)
		{
			//alert("updating");
			var update_values = "";
			if (site =='main')
				{
					URL_String = "_php_files/update_database.php?site="+site+"&gotoURL="+gotoURL+"&table_name="+table_name+"&key_field="+key_field+"&key_field_value="+key_field_value+"&action="+element_id+"&";
				}
			else if (site == 'admin')
				{
					URL_String = "../_php_files/update_database.php?site="+site+"&gotoURL="+gotoURL+"&table_name="+table_name+"&key_field="+key_field+"&key_field_value="+key_field_value+"&action="+element_id+"&";
				}
			//Look at each form element and if it is a checkbox, radio button, list or textarea then
			//get its value.  This is done under the assumption that these particular form elements will always be posted as an update
			//whether or not they have changed.
			//NOTE: Therefore, DO NOT do an OnChange for these elements when setting up the HTML form. && (frm.elements[i].value != "")
	   		for (i=0;i<frm.elements.length;i++)
				{
					if ((frm.elements[i].type == "checkbox")||(frm.elements[i].type == "radio"))
						{
							frm.elements[i].name = "changed_"+frm.elements[i].name;
							//if it is checked
							if (frm.elements[i].checked)
								{
									update_values += frm.elements[i].name+"=T";
								}
							//if it is not checked	
							else 
								{
									update_values += frm.elements[i].name+"=F";
								}
						}
					else if ((frm.elements[i].type == "list" )&& ((frm.elements[i].id == "month") || (frm.elements[i].id == "day") || (frm.elements[i].id == "year")))
						{
							//alert("It is a list");
							update_values += frm.elements[i].name+"_"+frm.elements[i].id+"="+frm.elements[i].value+"&";
						}
/*
					else if ((frm.elements[i].type == "password") && (frm.elements[i].id == "password"))
						{
							 frm.elements[i].name="changed_"+frm.elements[i].name;
						}
*/
					else if ((frm.elements[i].type == "file") && (frm.elements[i].value != ""))
						{
							//add the name of the file input box to the string  "box_name".
							URL_String += "box_name="+frm.elements[i].name+"&";
						}
					else	
						{
							//The else covers the all the stuff that was changed using the OnChange.
							//find the appropriate element in the form_values array.
							//NOTE:  This array was loaded using the onChange event for the form types being checked.
							//       Therefore, only elements that were changed should be found in the form_values[][] array
							//alert("length of form_values is "+form_values.length);
							//alert("form_values["+j+"][0] = "+form_values[j][0]);
							for (j=0;j<form_values.length;j++)
								{
									//alert("frm.elements[i].name = "+frm.elements[i].name+"\nfrm values[#][0] = "+form_values[j][0]);
									if (frm.elements[i].name == form_values[j][0])
										{
											//put the new name on the element ("CHANGED_nnnn")
											frm.elements[i].name=form_values[j][5];
										}
									//alert("update values in array for next = "+update_values);
								}
						}
					//
				}
			//Now that the form elements that have changed have been loaded into the final_values array,
			//complete the URL that will pass these variables to the update page.
			//alert("update values for form element type "+frm.elements[i].type+" = "+update_values);
			frm.action = URL_String;
			//alert("form action = "+frm.action);
			frm.submit();
		}
	function send_message(frm,site,gotoURL)
		{
			//alert("here");
			//NOTE:  send_mail.php file required in the php folder
			//		This folder and file name may be different but it will have to be changed in this function
			var elen = frm.elements.length;
			var stng = "";
			var string_value = "";
			clean_the_data(frm)
			cb_element_names = new Array;
			cb_unique_names = new Array;
			for (i=0; i<elen; i++)
				{
					//if the element is a checkbox and checked then capture the name attribute and the element number for later
					if (frm.elements[i].type == "checkbox")
						{
							if (frm.elements[i].checked)
								{
									//alert ("checkbox "+frm.elements[i].name+" is checked");
									string_value += frm.elements[i].name+"="+frm.elements[i].value+"&";
								}
/*
							j = cb_element_names.length
							cb_element_names[j][0] = frm.elements[i].name;
							cb_element_names[j][1] = i;
*/
						}
					//for all other elements capture the value in "string_value"
					else
						{
							string_value += frm.elements[i].name+"="+frm.elements[i].value+"&";
						}
				}
			//***** CHANGE ***** CHANGE ***** CHANGE ***** CHANGE *****
			//Advise verifying php file name in following statement	
			if (site == "admin")
				{
					window.location="../send_mail.php?" + string_value+"gotoURL="+gotoURL;
				}
			else if (site == "main")
				{
					window.location="send_mail.php?" + string_value+"gotoURL=../"+gotoURL;
				}
			else
				{
					alert("there is a problem sending this message");
				}
		}
	function starter(url,which,k) 
		{
			updateK(k)
			document.forms[0].elements[k+1].focus() 
			func = eval("more" + which)
			func(url) 
		}