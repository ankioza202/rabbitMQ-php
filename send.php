<?php
/**
 * Created by PhpStorm.
 * User: aoza002c
 * Date: 2019-04-02
 * Time: 16:58
 */


require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


//$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');


$connection = new AMQPStreamConnection('192.168.99.100', 5672, 'guest', 'guest');


$channel = $connection->channel();
$channel->queue_declare('test_queue', false, true, false, false);

$msg = new AMQPMessage('Ankita');
$channel->basic_publish($msg, 'test_exchange', 'red');
echo " [x] Sent 'Ankita'\n";
$channel->close();
$connection->close();