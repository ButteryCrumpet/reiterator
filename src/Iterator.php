<?php

namespace ReIterator;


use ReIterator\Exceptions\ClassNotFoundException;
use ReIterator\Iterators\Chain;
use ReIterator\Iterators\Enumerate;
use ReIterator\Iterators\Filter;
use ReIterator\Iterators\FilterMap;
use ReIterator\Iterators\FlatMap;
use ReIterator\Iterators\Flatten;
use ReIterator\Iterators\ForEachIter;
use ReIterator\Iterators\Map;
use ReIterator\Iterators\Peekable;
use ReIterator\Iterators\Skip;
use ReIterator\Iterators\SkipWhile;
use ReIterator\Iterators\StepBy;
use ReIterator\Iterators\Take;
use ReIterator\Iterators\TakeWhile;
use ReIterator\Iterators\Zip;

/**
 * Implementation of IteratorInterface
 *
 * Class Iterator
 * @package ReIterator
 */
class Iterator implements IteratorInterface
{
    /**
     * @var \Iterator
     */
    protected $from;

    /**
     * Creates a ReIterator\Iterator from an array
     *
     * @param array $array
     * @return Iterator
     */
    public static function fromArray(array $array)
    {
        return new Iterator(new \ArrayIterator($array));
    }

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

    /**
     * @{@inheritdoc}
     */
    public function fold(\Closure $fn, $init)
    {
        $acc = $init;
        foreach ($this as $item)
        {
            $acc = call_user_func($fn, $acc, $item);
        }
        return $acc;
    }

    /**
     * @return int
     */
    public function count()
    {
        $this->rewind();
        $count = 0;
        while ($this->valid()) {
            $count = $count + 1;
            $this->next();
        }
        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        $this->rewind();
        while ($this->valid()) {
            $this->next();
        }
        return $this->current();
    }

    /**
     * {@inheritdoc}
     */
    public function nth($n)
    {
        $this->rewind();
        $count = 0;
        while ($count !== $n && $this->valid()) {
            $count = $count + 1;
            $this->next();
        }
        return $this->current();
    }

    /**
     * {@inheritdoc}
     */
    public function step_by($step)
    {
        return new StepBy($this, $step);
    }

    /**
     * {@inheritdoc}
     */
    public function chain(\Iterator $iterator)
    {
        return new Chain($this, $iterator);
    }

    /**
     * {@inheritdoc}
     */
    public function zip(\Iterator $iterator)
    {
        return new Zip($this, $iterator);
    }

    /**
     * {@inheritdoc }
     */
    public function map(\Closure $fn)
    {
        return new Map($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function for_each(\Closure $fn)
    {
        return new ForEachIter($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function filter(\Closure $fn)
    {
        return new Filter($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function filter_map(\Closure $fn)
    {
        return new FilterMap($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function enumerate()
    {
        return new Enumerate($this);
    }

    /**
     * {@inheritdoc}
     */
    public function skip_while(\Closure $fn)
    {
        return new SkipWhile($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function take_while(\Closure $fn)
    {
        return new TakeWhile($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function skip($n)
    {
        return new Skip($this, $n);
    }

    /**
     * {@inheritdoc}
     */
    public function take($n)
    {
        return new Take($this, $n);
    }

    /**
     * {@inheritdoc}
     */
    public function flatten()
    {
        return new Flatten($this);
    }

    /**
     * {@inheritdoc}
     */
    public function flat_map(\Closure $fn)
    {
        return new FlatMap($this, $fn);
    }

    /**
     * {@inheritdoc}
     */
    public function reverse()
    {
        // TODO: Implement reverse() method.
    }

    /**
     *{@inheritdoc}
     */
    public function peekable()
    {
        return new Peekable($this);
    }

    // collect to something?

    /**
     * {@inheritdoc}
     */
    public function collect()
    {
        $arr = [];
        foreach ($this as $val) {
            $arr[] = $val;
        }
        return $arr;
    }

    /**
     * {@inheritdoc}
     */
    public function into($type)
    {
       if (!class_exists($type))
       {
           throw new ClassNotFoundException("Class $type could not be found");
       }

       $into = new $type;

       if (!($into instanceof \ArrayAccess))
       {

       }
    }
}
