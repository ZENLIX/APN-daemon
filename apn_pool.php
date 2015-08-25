<?php
date_default_timezone_set('Europe/Kiev');
$CONF_DB = array (
'host' 		=> 'localhost',
'username'	=> 'admin',
'password'	=> 'pass',
'db_name'	=> 'admin'
);

$base = dirname(__FILE__); 

$dbConnection = new PDO('mysql:host=' . $CONF_DB['host'] . ';dbname=' . $CONF_DB['db_name'], $CONF_DB['username'], $CONF_DB['password'], array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


error_reporting(-1);

$seconds = 2;

$micro = $seconds * 1000000;

while(true){
 $stmt = $dbConnection->prepare('SELECT * from push_pool where status = 0');
    $stmt->execute();
    $res1 = $stmt->fetchAll();
if (!empty($res1)) {

require_once $base.'/ApnsPHP/Autoload.php';

$push = new ApnsPHP_Push(
	ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
	$base.'/ap.pem'
);

$push->connect();

foreach ($res1 as $row) {
	
	$dt=$row['device_token'];
	
	if (strlen($row['device_token']) == 64 ) {
	
$message = new ApnsPHP_Message_Custom($dt);
$message->setCustomIdentifier("Message-Badge-1");
$message->setBadge(1);
$message->setText($row['msg']);
$message->setSound();
$message->setCat($row['cat']);
$message->setCustomProperty('ticket_hash', $row['ticket_hash']);

$message->setExpiry(300);
$push->add($message);

$stmt2 = $dbConnection->prepare('update push_pool set status = :s where id=:id');
$stmt2->execute(array(':s'=>'1', ':id'=>$row['id']));
    
}



}

if (!empty($res1)) {
$push->send();
}
// Disconnect from the Apple Push Notification Service
$push->disconnect();
}

usleep($micro);

}




?>
