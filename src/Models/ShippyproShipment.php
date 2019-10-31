<?php

namespace yax\ShippyProConnector\Models;
use yax\ShippyProConnector\Services\ShippyProClient;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

class ShippyproShipment
{
    protected $from_address, $to_address, $parcels;
    protected $Insurance = 0, $InsuranceCurrency = "EUR", $CashOnDelivery = 0, $CashOnDeliveryCurrency="EUR", $ContentDescription, $TotalValue, $ShippingService = "Standard", $RateCarriers;
    protected $TransactionID, $CarrierName, $CarrierService, $CarrierID, $OrderID, $RateID, $CN22Info;
    protected $client;
    public function __construct(float $TotalValue, $ContentDescription)
    {
        $this->client = new ShippyProClient();
        $this->TotalValue = $TotalValue;
        $this->ContentDescription = $ContentDescription;
        $this->parcels = collect();
    }
    /**
     * Add parcel to the shipment
     *
     * @param ShippyproParcel Parcel object, this object will be pushed to parcels collection
     *
     * @return Shipment parcels collection
     */
    public function addParcel(ShippyproParcel $parcel) : Collection{
        $this->parcels->push($parcel);
        return $this->parcels;
    }
    /**
     * Set Customs declaration of the shipment
     *
     * @param string $description Custom Declaration description
     * @param string $weight Shipment weight
     * @param string $quantity Items in shipment
     * @param string $UnitValue
     * @param string $OriginCountry Country code
     * @param string $Currency Currency code
     * @param string $HSCode Products HSCode
     *
     * @return self Shipment object
     */
    public function setCustomsDeclaration($description, $weight, $quantity, $UnitValue, $OriginCountry, $Currency, $HSCode) : self {
        $arr = [];
        $arr['Description'] = $description;
        $arr['Weight'] = $weight;
        $arr['Quantity'] = $quantity;
        $arr['UnitValue'] = $UnitValue;
        $arr['OriginCountry'] = $OriginCountry;
        $arr['Currency'] = $Currency;
        $arr['HSCode'] = $HSCode;
        $this->CN22Info = $arr;
        return $this;
    }
    /**
     * Set from_address of the shipment
     *
     * @param ShippyproAddress $address Sender address
     *
     * @return self Shipment object
     */
    public function from_address(ShippyproAddress $address) : self{
        $this->from_address = $address;
        return $this;
    }
    /**
     * Set to_address of the shipment
     *
     * @param ShippyproAddress $address Recivier address
     *
     * @return self Shipment object
     */
    public function to_address(ShippyproAddress $address) : self{
        $this->to_address = $address;
        return $this;
    }

    /**
     * Set insurance of the shipment
     *
     * @param float $value Insurance value
     * @param string $currency Insurance currency
     *
     * @return self Shipment object
     */
    public function setInsurance($value, $currency) : self{
        $this->Insurance = $value;
        $this->InsuranceCurrency = $currency;
        return $this;
    }

    /**
     * Set cash on delivery
     *
     * @param string $currency Currency format
     *
     * @return self Shipment object
     */
    public function setCashOnDelivery($currency) : self{
        $this->CashOnDelivery = 1;
        $this->CashOnDeliveryCurrency = $currency;
        return $this;
    }

    /**
     * Set transaction ID
     *
     * @param integer id
     *
     * @return void
     */
    public function setTransactionId($id){
        $this->TransactionID = 'ORDER'.$id;
        $this->OrderID = 'ORDER'.$id;
    }

    /**
     * Set shipment's rate
     *
     * @param ShippyproRate rate Selected carrier rate
     *
     * @return void
     */
    public function setRate(ShippyproRate $rate){
        $this->CarrierName = $rate->carrier;
        $this->CarrierService = $rate->service;
        $this->CarrierID = $rate->carrier_id;
        $this->RateID = $rate->rate_id;
    }

    /**
     * Purchase shipment
     *
     * @throws \Exception something went wrong on API side
     * @return ShippyproOrder
     */
    public function purchase(){
        return $this->client->ship($this);
    }

    /**
     * Get shipment's rates
     *
     * @throws \Exception something went wrong on API side
     * @return \yax\ShippyProConnector\Collection\Collection Rates collection
     */
    public function getRates() : \yax\ShippyProConnector\Collection\Collection{
        $rates = $this->client->rates($this);
        $rates_collection = new \yax\ShippyProConnector\Collection\Collection();
        foreach ($rates->Rates as $r){
            $rates_collection->push(new ShippyproRate($r));
        }
        return $rates_collection;
    }

    /**
     * Convert parcels to array
     *
     * @return array Parcels array
     */
    public function parcelsToArray() : array{
        $array = array();
        foreach ($this->parcels as $parcel){
            array_push($array, $parcel->toArray());
        }
        return $array;
    }
    /**
     * Convert shipment to array
     *
     * @return array Shipment array
     */
    public function toArray() : array {
        return [
            'from_address' => $this->from_address->toArray(),
            'to_address' => $this->to_address->toArray(),
            'parcels' => $this->parcelsToArray(),
            'Insurance' => $this->Insurance,
            'InsuranceCurrency' => $this->InsuranceCurrency,
            'CashOnDelivery' => $this->CashOnDelivery,
            'CashOnDeliveryCurrency' => $this->CashOnDeliveryCurrency,
            'ContentDescription' => $this->ContentDescription,
            'TotalValue' => (string) $this->TotalValue,
            'ShippingService' => $this->ShippingService,
            'TransactionID' => ($this->TransactionID) ? $this->TransactionID : null,
            'CarrierName' => ($this->CarrierName) ? $this->CarrierName : null,
            'CarrierService' => ($this->CarrierService) ? $this->CarrierService : null,
            'CarrierID' => ($this->CarrierID) ? (integer) $this->CarrierID : null,
            'OrderID' => ($this->OrderID) ? $this->OrderID : null,
            'RateID' => ($this->RateID) ? $this->RateID : null,
            'CN22Info' => ($this->CN22Info)? $this->CN22Info : null
        ];
    }
}
