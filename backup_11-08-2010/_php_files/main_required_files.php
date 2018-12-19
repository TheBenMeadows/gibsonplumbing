<?php 

/*Copyright March, 2004

This php file is the exclusive property of Glyn Barrows.

A right to use permission is granted to Daemon Systems

for use in administering the gibson plumbing  Web Site

*/

	require_once('connections/conn_chs.php');

	require_once('_php_files/GetTheDate.php');

	require_once('_php_files/static_arrays.php');

	require_once('_php_files/general_functions.php');

	//require_once('_php_files/gd_functions.php');

	//require_once('_php_files/shopping_cart_functions.php');

	require_once('_php_files/gd_functions.php');	

	//$conn_archive_db = $conn_asrv;

	$main_db = $database_conn_chs;

	$conn_main_db = $conn_chs;

	$adminpage = "_admin/gp_administration.php";

	$home_page = "index.htm";

?>

