<?php

namespace ReIterator;


interface PeekableIteratorInterface extends IteratorInterface
{

    /**
     * Peek at the next value in an iterator
     * without moving the iterator's cursor
     * forward
     *
     * @return mixed
     */
    public function peek();
}
