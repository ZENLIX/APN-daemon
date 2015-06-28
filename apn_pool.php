<?php
date_default_timezone_set('Europe/Kiev');
$CONF_DB = array (
'host' 		=> 'localhost',
'username'	=> 'name',
'password'	=> 'pass',
'db_name'	=> 'name'
);

$base = dirname(__FILE__); 

$dbConnection = new PDO('mysql:host=' . $CONF_DB['host'] . ';dbname=' . $CONF_DB['db_name'], $CONF_DB['username'], $CONF_DB['password'], array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    

//apns-dev.pem



            //if (!empty($result)) {
            //foreach ($result as $row) {
	            
	            



// Adjust to your timezone
date_default_timezone_set('Europe/Kiev');
// Report all PHP errors
error_reporting(-1);

$seconds = 2;

$micro = $seconds * 1000000;

while(true){
 $stmt = $dbConnection->prepare('SELECT * from push_pool where status = 0');
    $stmt->execute();
    $res1 = $stmt->fetchAll();
if (!empty($res1)) {

// Using Autoload all classes are loaded on-demand
require_once $base.'/ApnsPHP/Autoload.php';
// Instantiate a new ApnsPHP_Push object
$push = new ApnsPHP_Push(
	ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
	$base.'/ap.pem'
);
// Set the Provider Certificate passphrase
// $push->setProviderCertificatePassphrase('test');
// Set the Root Certificate Autority to verify the Apple remote peer
//$push->setRootCertificationAuthority('entrust_root_certification_authority.pem');
// Connect to the Apple Push Notification Service
$push->connect();
// Instantiate a new Message with a single recipient


foreach ($res1 as $row) {
	
	$dt=$row['device_token'];
	
	//echo $dt."<br>.";
	
	if (strlen($row['device_token']) == 64 ) {
	
	
	//echo $row['device_token']."<br><hr>";
	
$message = new ApnsPHP_Message_Custom($dt);
// Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
// over a ApnsPHP_Message object retrieved with the getErrors() message.
$message->setCustomIdentifier("Message-Badge-1");
// Set badge icon to "3"
$message->setBadge(1);
// Set a simple welcome text
$message->setText($row['msg']);
// Play the default sound
$message->setSound();
$message->setCat($row['cat']);
$message->setCustomProperty('ticket_hash', $row['ticket_hash']);
//$message->setCustomProperty('category', 'lock');
/*
$message->setCustomProperty('a', $row['ticket_action']);
$message->setCustomProperty('id', $row['ticket_id']);
$message->setCustomProperty('ui', $row['ticket_user_init']);
*/
// Set the expiry value to 30 seconds
$message->setExpiry(300);
// Add the message to the message queue
$push->add($message);
// Send all messages in the message queue


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
