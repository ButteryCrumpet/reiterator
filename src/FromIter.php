<?php

namespace ReIterator;


interface FromIter
{
    /**
     * @param IteratorInterface $iter
     * @return self
     */
    public static function FromIter(IteratorInterface $iter);
}