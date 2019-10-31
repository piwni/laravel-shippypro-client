<?php

namespace Mateusztumatek\Shippy_pro_connector\Models;

class ShippyproAddress{

    public $name, $company, $street1, $street2, $city, $state, $zip, $country, $phone, $email;
    public function __construct($name, $company, $street1, $street2, $city, $state, $zip, $country, $phone, $email)
    {
        $this->name = $name;
        $this->company =  $company;
        $this->street1 = $street1;
        $this->street2 = $street2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->phone = $phone;
        $this->email = $email;
    }
    public function toArray(){
        return [
            'name' => $this->name,
            'company' => $this->company,
            'street1' => $this->street1,
            'street2' => $this->street2,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }
}
