<?php


namespace App\system\Collections;


class Collection implements \Serializable
{

    protected $items = [];

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function count(){
        return count($this->items);
    }

    public function get(){
        return $this->items;
    }

    public function add($item){
        if(is_array($item) && count($item) > 1){
            array_merge($this->items, $item);
        }

        $this->items[] = $item;
    }

    public function merge(Collection $collection){
        return $this->items = array_merge( $this->items, $collection->get());
    }

    public function ToJson(){
        return $this->get();
    }


    /**
     * @inheritDoc
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }
}