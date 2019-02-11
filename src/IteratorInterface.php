<?php

namespace ReIterator;


/**
 * Rust inspired iterator implementation
 *
 * Interface IteratorInterface
 * @package ReIterator
 */
interface IteratorInterface extends \Iterator, \Countable
{
    /**
     * Get the last value of the iterator
     *
     * @return mixed
     */
    public function last();

    /**
     * Get the nth value of the iterator
     *
     * @param integer $n
     * @return mixed
     */
    public function nth($n);

    /**
     * Returns a new iterator that steps by the passed in amount
     * each iteration
     *
     * @param integer $step
     * @return IteratorInterface
     */
    public function step_by($step);

    /**
     * Returns a new iterator that chains the passed in
     * iterator, iterating over the second iterator after
     * the first one
     *
     * @param \Iterator $iterator
     * @return IteratorInterface
     */
    public function chain(\Iterator $iterator);

    /**
     * Returns a new iterator that zips up two iterators.
     * Stops iteration when the first Iterator ends, so
     * ignores any extra values in the second iterator.
     *
     * @param \Iterator $iterator
     * @return IteratorInterface
     */
    public function zip(\Iterator $iterator);

    /**
     * Returns a new iterator that maps the values
     * using the passed in closure
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function map(\Closure $fn);

    /**
     * Returns a new iterator that passes each value
     * into the closure passed in. Does not do anything
     * with any returned value.
     * Use this for side-effects
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function for_each(\Closure $fn);

    /**
     * Returns a new iterator that filters the values
     * based on the closure passed in.
     * The closure must return true or false.
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function filter(\Closure $fn);

    /**
     * Returns a new iterator that maps the values
     * using the passed in closure. If the closure
     * returns null it will filter out the value.
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function filter_map(\Closure $fn);

    /**
     * Returns a new iterator that returns a two
     * value array of index and value
     * (e.g [2, "second"])
     *
     * @return IteratorInterface
     */
    public function enumerate();

    /**
     * Returns a new iterator which skips elements
     * for as long as the closure returns true
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function skip_while(\Closure $fn);

    /**
     * Returns a new iterator which takes elements
     * for as long as the closure returns true
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function take_while(\Closure $fn);

    /**
     * Returns a new iterator which skips the first
     * n elements
     *
     * @param integer $n
     * @return IteratorInterface
     */
    public function skip($n);

    /**
     * Returns a new iterator which takes the first
     * n elements
     *
     * @param integer $n
     * @return IteratorInterface
     */
    public function take($n);

    //public function scan(); // necessary implementation?

    /**
     * Returns a new iterator which maps values based
     * on the closure but flattens any nested iterator or
     * array
     *
     * @param \Closure $fn
     * @return IteratorInterface
     */
    public function flat_map(\Closure $fn);

    /**
     * Returns a new iterator which flattens any
     * nested iterator or array
     *
     * @return IteratorInterface
     */
    public function flatten();

    /**
     * Collects the iterator into an array
     *
     * @return array
     */
    public function collect();

    /**
     * Collects the iterator into an array
     *
     * @param string $type
     * @return mixed
     */
    public function into($type);

    /**
     * Folds over the iterator passing in the current value
     * and the accumulator (whatever is returned from the
     * previous iteration) into the passed in closure.
     *
     * @param \Closure $fn
     * @param mixed $init
     * @return mixed
     */
    public function fold(\Closure $fn, $init);

    /**
     * Returns a new iterator that is peekable.
     * Peekable iterators have the peek() method
     * allowing for the ability to see the next
     * value without stepping the iterator by calling
     * next()
     *
     * @return PeekableIteratorInterface
     */
    public function peekable();

    /**
     * @return mixed
     */
    public function reverse();

}
