<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019-02-11
 * Time: 11:52
 */

namespace ReIterator;


class ClosureIterator extends Iterator
{
    private $fn;
    private $current = null;
    private $index = -1;

    public function __construct(\Closure $fn)
    {
        $this->fn = $fn;
        $this->next();
    }

    /*
    * {@inheritdoc}
    */
    public function current()
    {
        return $this->current;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->index = $this->index + 1;
        $this->current = call_user_func($this->fn, $this->index);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return !is_null($this->current);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->index = 0;
    }
}