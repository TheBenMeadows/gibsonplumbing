<?php

	require_once('connections/conn_gibson.php'); 

	//echo "Called from ".$_SERVER['HTTP_REFERER'];

	//Called from TEST  http://localhost/gibson/home_owners.php

	//     OR 

	//Called from public host  ===>  http://www.gibsonplumbing.com/page_one.php

	$where_from = $_SERVER['HTTP_REFERER'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

</head>



<body>

	GOT HERE FROM  <?PHP echo ($where_from) ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-18445742-1");
pageTracker._trackPageview();
} catch(err) {}</script>


</body>

</html>

