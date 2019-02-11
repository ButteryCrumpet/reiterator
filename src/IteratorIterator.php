<?php

namespace ReIterator;


class IteratorIterator extends Iterator
{
    /**
     * @var \Iterator
     */
    protected $from;

    /**
     * Constructor for ReIterator\Iterator
     *
     * @param \Iterator $from
     */
    public function __construct(\Iterator $from)
    {
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->from->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->from->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->from->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->from->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->from->rewind();
    }
}