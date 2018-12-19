<?php 
/*Copyright April, 2004
This php file is the exclusive property of Glyn Barrows.
A right to use permission is granted to DDS "Digital Display Solutions, INC." 
for use in administering the Digital Display Solutions Web Site
This is used in response to a POST method from the calling web page form
	require_once('../connections/conn_3chmain.php');
	require_once('../connections/conn_3charchive.php');
	require_once('cleanup_string.php');
	require_once('GetTheDate.php');
	$archive_db = $database_conn_3charchive;
	$conn_archive_db = $conn_3charchive;
	$main_db = $database_conn_3chmain;
	$conn_main_db = $conn_3chmain;
	$adminpage = "3ch_administration.php";
*/
	require_once('required_files.php');
?>
<?php
/* 
The calling form is submitted with a POST string as follows:
	MainDBTable='The table being deleted or updated'&
	KeyFieldName='The Key Field Name'&
	KeyFieldValue="The Key Field Value'&
	GotURL="The redirect URL after the database work is done'&
		NOTE: Next two fields used only if Xref table exists
		MTMTable= 'The crossReference Table'&
		MTMFieldName='The key field in the cross reference table'&
		URLString =  "MTMArchive_Delete.asp?
*/
$Thedate = Date("Y-m-d");
$x = 0;
$vals = " ";
/*Connect to the databases*/
mysql_select_db($main_db, $conn_main_db);
//mysql_select_db($archive_db, $conn_archive_db);
foreach($_POST as $name=>$value )
	{
		switch ($name)
				{
					case "table_name":
						$MainDBTable = $value;
						break;
					case "key_field":
						$KeyFieldName = $value;
						break;
					case "key_field_value":
						$KeyFieldValue = $value;
						break;
					case "gotoURL":
						$GoToURL = $value;
						break;
				}		
	}
foreach($_GET as $name=>$value )
	{
		switch ($name)
				{
					case "table_name":
						$MainDBTable = $value;
						break;
					case "key_field":
						$KeyFieldName = $value;
						break;
					case "key_field_value":
						$KeyFieldValue = $value;
						break;
					case "gotoURL":
						$GoToURL = $value;
						break;
				}		
	}
//mysql_query("INSERT INTO $archive_db.$MainDBTable SELECT * from $main_db.$MainDBTable WHERE $KeyFieldName=$KeyFieldValue"); 
mysql_query("DELETE from $main_db.$MainDBTable WHERE $KeyFieldName=$KeyFieldValue"); 
header("Location: $GoToURL?done=done");
?>