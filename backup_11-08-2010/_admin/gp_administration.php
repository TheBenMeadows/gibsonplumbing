<?php

if (!isset($_SESSION)) {

  session_start();

}

$MM_authorizedUsers = "1";

$MM_donotCheckaccess = "true";



// *** Restrict Access To Page: Grant or deny access to this page

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 

  // For security, start by assuming the visitor is NOT authorized. 

  $isValid = False; 



  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 

  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 

  if (!empty($UserName)) { 

    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 

    // Parse the strings into arrays. 

    $arrUsers = Explode(",", $strUsers); 

    $arrGroups = Explode(",", $strGroups); 

    if (in_array($UserName, $arrUsers)) { 

      $isValid = true; 

    } 

    // Or, you may restrict access to only certain users based on their username. 

    if (in_array($UserGroup, $arrGroups)) { 

      $isValid = true; 

    } 

    if (($strUsers == "") && true) { 

      $isValid = true; 

    } 

  } 

  return $isValid; 

}



$MM_restrictGoTo = "gp_login.php";

if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   

  $MM_qsChar = "?";

  $MM_referrer = $_SERVER['PHP_SELF'];

  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";

  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 

  $MM_referrer .= "?" . $QUERY_STRING;

  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);

  header("Location: ". $MM_restrictGoTo); 

  exit;

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

"http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		<title>

			Gibson Plumbing Administrative Dashboard

		</title>

		<script language="JavaScript" src = "../_javascript/_generic.js" type="text/JavaScript"></script>

		<script language="JavaScript" src = "../_javascript/_form_actions.js" type="text/JavaScript"></script>

		<script language="JavaScript" src = "../_javascript/_process_form.js" type="text/JavaScript"></script>

	    <link href="../css/admin_site.css" rel="stylesheet" type="text/css">

	</head>

	<body class="admin_page">

		<table border="0" align="center">

			<tr>

				<td width="145" valign="top">&nbsp;</td>

				<td class="style_title" width="351" align="right" >

			  		Gibson Plumbing <br>

					Admin Dashboard

			</td>

			</tr>

			<tr>

				<td colspan="2" valign="top"><div align="left"></div>

					<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

						<tr>

							<td width="550" align="right" class="style2">

								Please Select Add or Change for the item to be managed

							</td>

						</tr>

						<tr>

							<td width="481" align="right" class="style3">&nbsp; </td>

						</tr>

						<tr>

							<td>

								<form name="form1" method="post" action="">

									<table width="94%"  border="0" align="center">

										<tr>

											<td width="36%" class="style3"><div align="center">Admin Items </div></td>

											<td width="9%" class="style3" align="center"> Add </td>

											<td width="10%" class="style3" align="center"> Change </td>

											<td width="29%" align="center" class="style3">&nbsp;</td>

											<td width="16%" align="center" class="style3">&nbsp;</td>

										</tr>

										<tr>

										  <td colspan="5" class="style3"><div align="center">

										    <hr>

										  </div></td>

									  </tr>

										<tr>

										  <td colspan="5" align="right" nowrap="nowrap" class="style3"><div align="center">Maintanence Page </div></td>

									  </tr>

										<tr>

                                          <td class="style3" align="right" nowrap="nowrap">Categories  </td>

										  <td align="center">

										  <input name="radiobutton" id= "11" type="radio" value="add_maint_category" onClick="getform(this.form,this.value)">                                          </td>

										  <td align="center"><input name="radiobutton" id= "12" type="radio" value="change_maint_category" onClick="getform(this.form,this.value)">                                          </td>

										  <td>&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

										  <td class="style3" align="right" nowrap="nowrap">Vendors </td>

										  <td align="center">

                                            <input name="radiobutton" id= "11" type="radio" value="add_maint_vendor" onClick="getform(this.form,this.value)">                                          </td>

										  <td align="center">

                                            <input name="radiobutton" id= "12" type="radio" value="change_maint_vendor" onClick="getform(this.form,this.value)">                                          </td>

										  <td>&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

										  <td class="style3" align="right" nowrap="nowrap">Vendor Comments </td>

										  <td align="center"><input name="radiobutton" id= "11" type="radio" value="add_maint_ven_text" onClick="getform(this.form,this.value)">

                                          </td>

										  <td align="center"><input name="radiobutton" id= "12" type="radio" value="change_maint_ven_text" onClick="getform(this.form,this.value)">

                                          </td>

										  <td>&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

										  <td class="style3" align="right" nowrap="nowrap">Picture Categories  </td>

										  <td align="center"><input name="radiobutton" id= "11" type="radio" value="add_picture_category" onClick="getform(this.form,this.value)">                                          </td>

										  <td align="center"><input name="radiobutton" id= "12" type="radio" value="change_picture_category" onClick="getform(this.form,this.value)">                                          </td>

										  <td>&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

										  <td class="style3" align="right" nowrap="nowrap">Picture Size</td>

										  <td align="center">

                                            <input name="radiobutton" id= "11" type="radio" value="add_pic_sizes" onClick="getform(this.form,this.value)">                                          </td>

										  <td align="center">

                                            <input name="radiobutton" id= "12" type="radio" value="change_pic_sizes" onClick="getform(this.form,this.value)">                                          </td>

										  <td>&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

											<td colspan="5" align="right" nowrap="nowrap" class="style3"><div align="center">Warrenty &amp; Service Page </div></td>

										</tr>

										<tr>

											<td height="24" align="right" class="style3" nowrap="nowrap">Categories</td>

											<td align="center">

												<input name="radiobutton" id= "19" type="radio" alt="bulk" value="add_ws_category" onClick="getform(this.form,this.value)">											</td>

											<td align="center">

												<input name="radiobutton" id= "20" type="radio" value="change_ws_category" onClick="getform(this.form,this.value)">											</td>

											<td class="style3">&nbsp;</td>

											<td>&nbsp;</td>

										</tr>

										<tr>

                                          <td height="22" align="right" class="style3" nowrap="nowrap"> Category Text </td>

										  <td align="center">

                                            <input name="radiobutton" id= "21" type="radio" alt="bulk" value="add_ws_cat_info" onClick="getform(this.form,this.value)">                                          </td>

										  <td align="center">

                                            <input name="radiobutton" id= "22" type="radio" value="change_ws_cat_info" onClick="getform(this.form,this.value)">                                          </td>

										  <td class="style3">&nbsp;</td>

										  <td>&nbsp;</td>

									  </tr>

										<tr>

                                          <td height="22" colspan="5" align="right" class="style3"><div align="center">Contact Page </div></td>

									  </tr>

										<tr>

										  <td height="22" align="right" class="style3" nowrap="nowrap">Contacts</td>

										  <td align="center"><input name="radiobutton" id= "radio" type="radio" value="add_contact" onClick="getform(this.form,this.value)"></td>

										  <td align="center"><input name="radiobutton" id= "radio2" type="radio" value="change_contact" onClick="getform(this.form,this.value)"></td>

										  <td>&nbsp;</td>

										  <td class="style2" align="center"></td>

									  </tr>

										<tr>

                                          <td height="22" align="right" class="style3" nowrap="nowrap">Builders</td>

										  <td align="center"><input name="radiobutton" id= "radio3" type="radio" value="add_builders" onClick="getform(this.form,this.value)"></td>

										  <td align="center"><input name="radiobutton" id= "radio4" type="radio" value="change_builders" onClick="getform(this.form,this.value)"></td>

										  <td>&nbsp;</td>

										  <td class="style2" align="center">                                          </td>

									  </tr>

										<tr>

										  <td colspan="5" align="right" nowrap="nowrap" class="style3"><div align="center">

										    <p>Builders  Page </p>

										    </div></td>

									  </tr>

										<tr>

                                          <td height="22" align="right" class="style3" nowrap="nowrap">Plumbing Stages</td>

										  <td align="center"><input name="radiobutton" id= "radio3" type="radio" value="add_plumbing_stages" onClick="getform(this.form,this.value)"></td>

										  <td align="center"><input name="radiobutton" id= "radio4" type="radio" value="change_plumbing_stages" onClick="getform(this.form,this.value)"></td>

										  <td>&nbsp;</td>

										  <td class="style2" align="center"></td>

									  </tr>

										<tr>

										  <td colspan="5" align="right" nowrap="nowrap" class="style3"><div align="center">About Us Page </div></td>

									  </tr>

										<tr>

                                          <td height="22" align="right" class="style3" nowrap="nowrap">Topics</td>

										  <td align="center"><input name="radiobutton" id= "radio3" type="radio" value="add_about_us" onClick="getform(this.form,this.value)"></td>

										  <td align="center"><input name="radiobutton" id= "radio4" type="radio" value="change_about_us" onClick="getform(this.form,this.value)"></td>

										  <td>&nbsp;</td>

										  <td class="style2" align="center"></td>

									  </tr>

										

										<tr>

										  <td colspan="5" align="right" nowrap="nowrap" class="style3"><div align="center">Administrative Support Tools</div></td>

									  </tr>

										

										<tr>

											<td class="style3" align="right" nowrap="nowrap">

												Administrators											</td>

											<td align="center">

												<input name="radiobutton" id= "1" type="radio" value="add_administrators" onClick="getform(this.form,this.value)">											</td>

											<td align="center">

												<input name="radiobutton" id= "2" type="radio" value="change_administrators" onClick="getform(this.form,this.value)">											</td>

											<td>&nbsp;</td>

											<td>&nbsp;</td>

										</tr>

										<tr>

											<td colspan="5" class="style3">

												<hr>											</td>

										</tr>

										<tr>

										  <td colspan="5" class="style3"><div align="center">

										    <hr>

										  </div></td>

									  </tr>

									</table>

								</form>

							</td>

						</tr>

						<tr>

							<td class="style17">

								<span class="alink">

									<a href="gp_login.php" class="style19"> 

										Close this and Return to Login Page 

									</a>

								</span> 

							</td>

						</tr>

					</table>

				</td>

		  </tr>

		</table>

	</body>

</html>

