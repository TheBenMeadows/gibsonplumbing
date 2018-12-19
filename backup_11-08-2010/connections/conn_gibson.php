<?php

# FileName="Connection_php_mysql.htm"

# Type="MYSQL"

# HTTP="true"

$hostname_conn_gibson = "localhost";

$database_conn_gibson = "gibson_p";

$username_conn_gibson = "gib_usr";

$password_conn_gibson = "gib_plumb";

$conn_gibson = mysql_pconnect($hostname_conn_gibson, $username_conn_gibson, $password_conn_gibson) or trigger_error(mysql_error(),E_USER_ERROR); 

?>