<?php session_start();
define('DB_HOST', 'localhost');			# Leave this as localhost unless your database is on another server or you really know what you're doing here
define('DB_USER', 'flynismo');			# Change 'root' to your database username
define('DB_PASS', 'AndrewRout1977');	# Database password
define('DB', 'flynismo_dating');		# The database being connected to
mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB);


$query = "SELECT sendtime FROM mail_inbox WHERE recipient = '". $_SESSION['username'] ."' AND unread = 1 ORDER BY sendtime DESC";
$res = mysql_query($query);
$r = mysql_fetch_assoc($res);
$t = strtotime($r['sendtime']);
$range = time() - $t;

if($range <= 300000000)
{
$q = "SELECT * FROM mail_inbox WHERE recipient = '". $_SESSION['username'] ."' AND unread = 1 ORDER BY sendtime DESC";
$result = mysql_query($q);
$count = mysql_num_rows($result);
$r2 = mysql_fetch_assoc($result);
}


if(isset($count))
{?>

<span id="new_message2">New message from <?= $r2['sender']; ?> </span>

<?php 
}
?>