<?php

/**
 * Class BlockSingle
 */
class BlockSingle
{
    /**
     * @var int
     */
    public $nonce;

    /**
     * BlockSingle constructor.
     *
     * @param      $index
     * @param      $timestamp
     * @param      $data
     * @param null $previousHash
     */
    public function __construct($index, $timestamp, $data, $previousHash = null, $nextHash = null)
    {
        $this->index        = $index;
        $this->timestamp    = $timestamp;
        $this->data         = $data;
        $this->previousHash = $previousHash;
        $this->nextHash     = $nextHash;
        $this->hash         = $this->calculateHash();
        $this->nonce        = 0;
    }

    /**
     * @return string
     */
    public function calculateHash()
    {
        return hash(
            'sha256',
            $this->index . $this->previousHash . $this->timestamp . ((string)$this->data) . $this->nonce
        );
    }
}
