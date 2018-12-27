<?php
require_once __DIR__ . '/../BlockChain.php';

/*
Hack the chain, changing values in the first block.
*/

$testCoin = new BlockChain();

echo "mining block 1...\n";
$now = strtotime('now', time());
$testCoin->push(new Block(1, $now, 'amount: 4'));

echo "mining block 2...\n";
$testCoin->push(new Block(2, $now, 'amount: 10'));

echo 'Chain valid: ' . ($testCoin->isValid() ? 'true' : 'false') . "\n";

echo "Changing second block...\n";
$testCoin->getChain()[1]->setData('amount: 1000');
$testCoin->getChain()[1]->setHash($testCoin->getChain()[1]->calculateHash());

echo 'Chain valid: ' . ($testCoin->isValid() ? 'true' : 'false') . "\n";
