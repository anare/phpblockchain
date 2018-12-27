<?php
require_once __DIR__ . '/../BlockChain.php';

/*
Set up a simple chain and mine two blocks.
*/

$testCoin = new BlockChain();

echo "mining block 1...\n";
$now = strtotime('now', time());

$testCoin->push(new Block(1, $now, 'amount: 4'));

echo "mining block 2...\n";
$testCoin->push(new Block(2, $now, 'amount: 10'));

echo json_encode($testCoin->toArray(), JSON_PRETTY_PRINT);
