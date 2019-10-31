<?php

namespace Mateusztumatek\Shippy_pro_connector\Services;
use Mateusztumatek\Shippy_pro_connector\Models\ShippyproAddress;
use Mateusztumatek\Shippy_pro_connector\Models\ShippyproShipment;
use Illuminate\Support\Collection;
use Mateusztumatek\Shippy_pro_connector\Services\ShippyProRequest;
class ShippyProClient{
    protected $request;
    public function __construct()
    {
        $this->request = new ShippyProRequest();
    }
    public function rates(ShippyproShipment $shipment){
        try{
            $out = $this->request->call($shipment->toArray(), 'GetRates');
            if(property_exists($out, 'Error')){
                throw new \Exception('Authentication Error');
            }
            return $out;
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function ship(ShippyproShipment $shipment){
        try{
            $out = $this->request->call($shipment->toArray(), 'Ship');
            dd($out);
            return $out;
        }catch (\Exception $e){
            throw $e;
            throw new \Exception($e->getMessage());
        }
    }
    public function order($id){
        try{
            $out = $this->request->call(['OrderID' => (integer) $id], 'GetOrder');
            if(property_exists($out, 'Error')){
                throw new \Exception(new \Exception('Wrong order ID'));
            }
            return $out;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}

