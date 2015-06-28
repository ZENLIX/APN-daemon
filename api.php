<?php
	header('Content-Type: application/json');

$CONF_DB = array (
'host' 		=> 'localhost',
'username'	=> 'name',
'password'	=> 'pass',
'db_name'	=> 'name'
);

function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$dbConnection = new PDO('mysql:host=' . $CONF_DB['host'] . ';dbname=' . $CONF_DB['db_name'], $CONF_DB['username'], $CONF_DB['password'], array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$data_json = json_decode( file_get_contents('php://input') );



if (isset($data_json->device_token, $data_json->msg)) {
	
	$msg=$data_json->msg;
	$dt=$data_json->device_token;
	$th=$data_json->th;
	$cat=$data_json->cat;
	
	
	    $stmt_n = $dbConnection->prepare('insert into push_pool (msg, device_token, from_ip, dt, ticket_hash, cat
	    ) VALUES (:msg, :device_token, :ip, now(), :ticket_hash, :cat
	    
	    )');
    $stmt_n->execute(array(
        ':msg' => $msg,
        ':device_token' => $dt,
        ':ip' => get_client_ip(),
        ':ticket_hash'=>$th,
        ':cat'=>$cat
        
    ));
	
	
	
	}


	
	
	?>