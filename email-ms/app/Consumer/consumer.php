<?php

$conf = new \RdKafka\Conf();
$conf->set('bootstrap.servers', "kafka:9092");

$consumer = new \RdKafka\Consumer($conf);
//$consumer->addBrokers("kafka:9092");
$consumer->setLogLevel(LOG_DEBUG);
//$consumer->set('bootstrap.servers',  "localhost:9092");
//$consumer->addBrokers("localhost:9092");

$topic = $consumer->newTopic("test");

$topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

echo "consumer started";
while (true) {
    $msg = $topic->consume(0, 1000);
    if ($msg->payload) {
        echo $msg->payload, "\n";
    }
}