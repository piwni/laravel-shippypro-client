<?php

namespace yax\ShippyProConnector\Services;
use yax\ShippyProConnector\Models\ShippyproAddress;
use yax\ShippyProConnector\Models\ShippyproShipment;
use Illuminate\Support\Collection;
use yax\ShippyProConnector\Services\ShippyProRequest;

/**
 * Shippypro Client that allows to communicate between Model and Request class
 *
 */
class ShippyProClient{
    protected $request;

    public function __construct()
    {
        $this->request = new ShippyProRequest();
    }

    /**
     * Allows to get carrier rates from Shippypro
     *
     * @param ShippyproShipment $shipment Shipment object
     *
     * @throws \Exception Shippypro API excepction
     * @return object Response from Shippypro API, contain rates information
     */
    public function rates(ShippyproShipment $shipment){
        try{
            $out = $this->request->call($shipment->toArray(), 'GetRates');
            if(property_exists($out, 'Error')){
                throw new \Exception($out->Error);
            }
            return $out;
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Allows to order shipment with specify rate
     *
     * @param ShippyproShipment $shipment Shipment object with valid Rate information
     *
     * @throws \Exception Shippypro API excepction
     * @return object Response from Shippypro API, contain order information
     */
    public function ship(ShippyproShipment $shipment){
        try{
            $out = $this->request->call($shipment->toArray(), 'Ship');
            if(property_exists($out, 'Error')){
                throw new \Exception($out->Error);
            }            return $out;
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * Allow to get Order from Shippypro by ID
     *
     * @param integer $id Order id
     *
     * @throws \Exception Shippypro API excepction
     * @return object Response from Shippypro API, contain order information
     */
    public function order($id){
        try{
            $out = $this->request->call(['OrderID' => (integer) $id], 'GetOrder');
            if(property_exists($out, 'Error')){
                throw new \Exception(new \Exception($out->Error));
            }
            return $out;
        }catch (\Exception $e){
            throw $e;
        }
    }
}

