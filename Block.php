<?php

require_once __DIR__ . '/BlockInterface.php';

/**
 * Class Block
 */
class Block implements BlockInterface
{
    /**
     * @var int
     */
    protected $index;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var ?string
     */
    protected $previousHash;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $nonce;

    /**
     * Block constructor.
     *
     * @param      $index
     * @param      $timestamp
     * @param      $data
     * @param null $previousHash
     */
    public function __construct($index, $timestamp, $data, $previousHash = null)
    {
        $this->index        = $index;
        $this->timestamp    = $timestamp;
        $this->data         = $data;
        $this->previousHash = $previousHash;
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

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     *
     * @return BlockInterface|$this|self|static
     */
    public function setIndex(int $index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     *
     * @return BlockInterface|$this|self|static
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     *
     * @return BlockInterface|$this|self|static
     */
    public function setData(string $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousHash()
    {
        return $this->previousHash;
    }

    /**
     * @param mixed $previousHash
     *
     * @return BlockInterface|$this|self|static
     */
    public function setPreviousHash($previousHash)
    {
        $this->previousHash = $previousHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     *
     * @return BlockInterface|$this|self|static
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return int
     */
    public function getNonce(): int
    {
        return $this->nonce;
    }

    /**
     * @param int $nonce
     *
     * @return BlockInterface|$this|self|static
     */
    public function setNonce(int $nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * @param int $inc
     *
     * @return BlockInterface|$this|self|static
     */
    public function incNonce(int $inc = 1)
    {
        $this->nonce += $inc;

        return $this;
    }

    public function toArray()
    {
        return [
            'index'        => $this->index,
            'timestamp'    => $this->timestamp,
            'data'         => $this->data,
            'previousHash' => $this->previousHash,
            'hash'         => $this->hash,
            'nonce'        => $this->nonce,
        ];
    }
}
