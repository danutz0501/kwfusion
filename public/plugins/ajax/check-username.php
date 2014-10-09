<?php
define('DB_HOST', 'localhost');			# Leave this as localhost unless your database is on another server or you really know what you're doing here
define('DB_USER', 'flynismo');			# Change 'root' to your database username
define('DB_PASS', 'AndrewRout1977');	# Database password
define('DB', 'flynismo_dating');		# The database being connected to
mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB);

$name = $_POST['username'];
$name = mysql_real_escape_string($name);

$query = "SELECT username FROM user WHERE username='$name';";
$res = mysql_query($query);
$num = mysql_num_rows($res);

echo $num;
?>