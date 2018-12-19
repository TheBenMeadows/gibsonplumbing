<?php require_once('../_php_files/required_files.php'); ?>

<?php

// *** Validate request to login to this site.

if (!isset($_SESSION)) {

  session_start();

}



$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) {

  $_SESSION['PrevUrl'] = $_GET['accesscheck'];

}



if (isset($_POST['User_name'])) {

  $loginUsername=$_POST['User_name'];

  $password=$_POST['User_Password'];

  $MM_fldUserAuthorization = "";

  $MM_redirectLoginSuccess = "gp_administration.php";

  $MM_redirectLoginFailed = "gp_login.php";

  $MM_redirecttoReferrer = false;

  mysql_select_db($database_conn_gibson, $conn_gibson);

  

  $LoginRS__query=sprintf("SELECT id, password FROM administrators WHERE id='%s' AND password='%s'",

    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 

   

  $LoginRS = mysql_query($LoginRS__query, $conn_gibson) or die(mysql_error());

  $loginFoundUser = mysql_num_rows($LoginRS);

  if ($loginFoundUser) {

     $loginStrGroup = "";

    

    //declare two session variables and assign them

    $_SESSION['MM_Username'] = $loginUsername;

    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      



    if (isset($_SESSION['PrevUrl']) && false) {

      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	

    }

    header("Location: " . $MM_redirectLoginSuccess );

  }

  else {

    header("Location: ". $MM_redirectLoginFailed );

  }

}

?>

<?php

	mysql_select_db($main_db, $conn_main_db);

	$query_Recordset1 = "SELECT * FROM administrators";

	$Recordset1 = mysql_query($query_Recordset1, $conn_main_db) or die(mysql_error());

	$row_Recordset1 = mysql_fetch_assoc($Recordset1);

	$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	//echo($row_Recordset1['first_name']);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

"http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>

		<title>

			Gibson Plumbing Administrative Login

		</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		<script language="JavaScript" src = "../_javascript/_form_actions.js" type="text/JavaScript"></script>

		<script language="JavaScript" src = "../_javascript/_generic_javascript.js" type="text/JavaScript"></script>	

		<script language="JavaScript" src = "../_javascript/_process_forms.js" type="text/JavaScript"></script>

	    <link href="../_css/admin_site.css" rel="stylesheet" type="text/css">

	</head>

	<body class="admin_page">

		<table width="600" border="0" align="center">

			<tr>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

			</tr>

			<tr>

				<td colspan="3" align="center">Gibson Plumbing</td>

			</tr>

			<tr>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

			</tr>

				<td width="141" rowspan="2" valign="top">&nbsp;

				</td>

				<td class="style7">

					Please Login				</td>

				<td width="117">&nbsp;

				</td>

			</tr>

			<tr>

				<td width="328">

					<form action="<?php echo $loginFormAction; ?>" method="POST" name="Admin_Login" id="Admin_Login">

						<table width="100%" border="0">

							<tr>

								<td class="style7">

									User Name								</td>

								<td>

									<input name="User_name" type="text" id="User_name" tabindex="1">

								</td>

								<td>&nbsp;

									

								</td>

							</tr>

							<tr>

								<td class="style7">

									Password								</td>

								<td>

									<input name="User_Password" type="password" id="User_Password2" tabindex="2">

								</td>

								<td>&nbsp;

								</td>

							</tr>

							<tr>

								<td>&nbsp;

								</td>

			 					<td>

									<input name="Submit" type="submit" tabindex="3" value="Login">

										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				 					<input name="Submit2" type="button" tabindex="4" onClick="MM_goToURL('parent','../INDEX.HTM');return document.MM_returnValue" value="Cancel">

								</td>

								<td>&nbsp;

								</td>

							</tr>

						</table>

				  </form>

				</td>

				<td>&nbsp;

				</td>

			</tr>

			<tr>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

				<td>&nbsp;

				</td>

			</tr>

		</table>

		<script language="VBScript">

			document.Admin_Login.User_name.focus()

		</script>

	</body>

</html>

<?php

	mysql_free_result($Recordset1);

?>

