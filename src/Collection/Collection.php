<?php

namespace Mateusztumatek\Shippy_pro_connector\Collection;

class Collection extends \Illuminate\Support\Collection{
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
