<?php
require_once __DIR__ . '/Block.php';

/**
 * A simple blockchain class with proof-of-work (mining).
 */
class BlockChain
{
    /**
     * @var Block[]
     */
    protected $chain;

    /**
     * @var int
     */
    protected $difficulty;

    /**
     * Instantiates a new Blockchain.
     */
    public function __construct()
    {
        $this->chain      = [$this->createGenesisBlock()];
        $this->difficulty = 4;
    }

    /**
     * Gets the last block of the chain.
     *
     * @return BlockInterface
     */
    public function getLastBlock()
    {
        return $this->chain[count($this->chain) - 1];
    }

    /**
     * Pushes a new block onto the chain.
     */
    public function push(BlockInterface $block)
    {
        $block->setPreviousHash($this->getLastBlock()->getHash());
        $this->mine($block);
        $this->chain[] = $block;

        return $this;
    }

    /**
     * Mines a block.
     *
     * @param BlockInterface $block
     */
    public function mine(BlockInterface $block)
    {
        while (strpos($block->getHash(), str_repeat('0', $this->difficulty)) !== 0) {
            $block->incNonce();
            $block->setHash($block->calculateHash());
        }

        echo "Block mined: " . $block->getHash() . "\n";
    }

    /**
     * Validates the blockchain's integrity. True if the blockchain is valid, false otherwise.
     */
    public function isValid()
    {
        $iMax = count($this->chain);
        for ($i = 1; $i <= $iMax; $i++) {
            $currentBlock  = $this->chain[$i] ?? null;
            $previousBlock = $this->chain[$i - 1] ?? null;

            if ($currentBlock === null) {
                continue;
            }

            if ($currentBlock->getHash() !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($previousBlock === null) {
                continue;
            }

            if ($currentBlock->getPreviousHash() !== $previousBlock->getHash()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Creates the genesis block.
     */
    private function createGenesisBlock()
    {
        return new Block(0, strtotime('2017-01-01'), 'Genesis Block');
    }

    /**
     * @return Block[]
     */
    public function getChain(): array
    {
        return $this->chain;
    }

    /**
     * @param Block[] $chain
     *
     * @return BlockChain
     */
    public function setChain(array $chain)
    {
        $this->chain = $chain;

        return $this;
    }

    /**
     * @return int
     */
    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    /**
     * @param int $difficulty
     *
     * @return BlockChain
     */
    public function setDifficulty(int $difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->chain as $block) {
            $result[] = $block->toArray();
        }

        return $result;
    }
}
