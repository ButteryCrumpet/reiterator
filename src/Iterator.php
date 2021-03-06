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
use ReIterator\Iterators\ZipKeys;

/**
 * Implementation of IteratorInterface
 *
 * Class Iterator
 * @package ReIterator
 */
abstract class Iterator implements IteratorInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function current();

    /**
     * {@inheritdoc}
     */
    abstract public function next();

    /**
     * {@inheritdoc}
     */
    abstract public function key();

    /**
     * {@inheritdoc}
     */
    abstract public function valid();

    /**
     * {@inheritdoc}
     */
    abstract public function rewind();

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
        $value = null;
        while ($this->valid()) {
            $value = $this->current();
            $this->next();
        }
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function nth($n)
    {
        $this->rewind();
        $count = 1;
        while ($count < $n && $this->valid()) {
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

    public function zip_keys()
    {
        return new ZipKeys($this);
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

        if (is_string($type)) {

            if (!class_exists($type))
            {
                throw new ClassNotFoundException("Class $type could not be found");
            }

            if (is_subclass_of($type, FromIter::class)) {
                return $type::FromIter($this);
            }

            $type = new $type();
        }

       if ($type instanceof \ArrayAccess || $type instanceof \stdClass)
       {
            foreach ($this as $value) {
                $type[] = $value;
            }
            return $type;
       }

       throw new \InvalidArgumentException("Type must be of string or \ArrayAccess.");

    }
}
