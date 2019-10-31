<?php

namespace Mateusztumatek\Shippy_pro_connector\Models;
class ShippyproParcel{
    public $length, $width, $height, $weight;
    public function __construct($length, $width, $height, $weight)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
    }
    public function toArray(){
        return [
            'length' => (integer) number_format($this->length, 0),
            'width' => (integer) number_format($this->width, 0),
            'height' => (integer) number_format($this->height, 0),
            'weight' => (integer) number_format($this->weight, 0)
        ];
    }
}
