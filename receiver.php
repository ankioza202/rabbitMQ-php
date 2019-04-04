<?php
/**
 * Created by PhpStorm.
 * User: aoza002c
 * Date: 2019-04-03
 * Time: 16:35
 */


require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('192.168.99.100', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('test_queue', false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('test_queue', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>
