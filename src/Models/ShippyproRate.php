<?php

namespace Piwni\Shippy_pro_connector\Models;
class ShippyproRate{
    public $carrier, $order_id, $carrier_id, $carrier_label, $rate, $rate_id, $delivery_days, $service, $currency, $zone_name, $weight_range, $detailed_pricing;

    /**
     * Add parcel to Shipment object
     *
     * @param object params Params returned from Shippypro API
     *
     * @return void
     */
    public function __construct($params)
    {
        foreach ($params as $key => $param){
            if(property_exists($this, $key)){
                $this->$key = $param;
            }
        }
    }
}
