<?php 

/*Copyright March, 2004

This php file is the exclusive property of Glyn Barrows.

A right to use permission is granted to Daemon Systems

for use in administering the gibson plumbing  Web Site

*/

	require_once('../connections/conn_gibson.php');

	require_once('GetTheDate.php');

	require_once('static_arrays.php');

	require_once('general_functions.php');

	require_once('gd_functions.php');

	//$archive_db = $database_conn_3charchive;

	//$conn_archive_db = $conn_3charchive;

	$main_db = $database_conn_gibson;

	$conn_main_db = $conn_gibson;

	$adminpage = "../_admin/gp_administration.php";

	$home_page = "../index.htm";

?>

