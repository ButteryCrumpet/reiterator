<?php

namespace ReIterator;


class ArrayIterator extends Iterator
{
    private $arr;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return \current($this->arr);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        \next($this->arr);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return \key($this->arr);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return key($this->arr) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        return \reset($this->arr);
    }


}