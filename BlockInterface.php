<?php

/**
 * Interface BlockInterface
 */
interface BlockInterface
{
    /**
     * @return string
     */
    public function calculateHash();

    /**
     * @return int
     */
    public function getIndex(): int;

    /**
     * @param int $index
     *
     * @return BlockInterface|$this|self|static
     */
    public function setIndex(int $index);

    /**
     * @return int
     */
    public function getTimestamp(): int;

    /**
     * @param int $timestamp
     *
     * @return BlockInterface|$this|self|static
     */
    public function setTimestamp(int $timestamp);

    /**
     * @return string
     */
    public function getData(): string;

    /**
     * @param string $data
     *
     * @return BlockInterface|$this|self|static
     */
    public function setData(string $data);

    /**
     * @return mixed
     */
    public function getPreviousHash();

    /**
     * @param mixed $previousHash
     *
     * @return BlockInterface|$this|self|static
     */
    public function setPreviousHash($previousHash);

    /**
     * @return string
     */
    public function getHash(): string;

    /**
     * @param string $hash
     *
     * @return BlockInterface|$this|self|static
     */
    public function setHash(string $hash);

    /**
     * @return int
     */
    public function getNonce(): int;

    /**
     * @param int $nonce
     *
     * @return BlockInterface|$this|self|static
     */
    public function setNonce(int $nonce);

    /**
     * @param int $inc
     *
     * @return BlockInterface|$this|self|static
     */
    public function incNonce(int $inc = 1);
}
