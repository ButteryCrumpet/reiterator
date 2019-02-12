<?php

namespace ReIterator;


class IteratorIterator extends Iterator
{
    protected $_iter = 0;
    /**
     * @var \Iterator
     */
    protected $inner;

    /**
     * Constructor for ReIterator\Iterator
     *
     * @param \Iterator $inner
     */
    public function __construct(\Iterator $inner)
    {
        $this->inner = $inner;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->inner->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->inner->next();
        $this->_iter = $this->_iter + 1;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->inner->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->inner->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->inner->rewind();
    }
}