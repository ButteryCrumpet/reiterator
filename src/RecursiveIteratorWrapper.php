<?php

namespace ReIterator;


class RecursiveIteratorWrapper extends Iterator implements \RecursiveIterator
{
    /**
     * @return \RecursiveIterator
     */
    public function getChildren()
    {
        $current = $this->current();

        if (is_array($current)) {
            return new \RecursiveArrayIterator($current);
        }

        if ($current instanceof \RecursiveIterator)
        {
            return $current;
        }

        if ($current instanceof \Iterator)
        {
            return new RecursiveIteratorWrapper($current);
        }

        return new \RecursiveArrayIterator([$current]);
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        $current = $this->current();
        return is_array($current) || ($current instanceof \RecursiveIterator);
    }

}