<?php

namespace Piwni\Shippy_pro_connector\Collection;

/**
 * This class extends standard laravel Collection, and add search by key functionality
 **/
class Collection extends \Illuminate\Support\Collection{

    /**
     * Search by key and value pair
     *
     * @return Collection item
     */
    public function searchByKey($key, $value)
    {
        return $this->first(function($item)use($key, $value){
           if(is_array($item)){
               return $item[$key] == $value;
           }else{
                return $item->$key == $value;
           }
        });
    }
}
