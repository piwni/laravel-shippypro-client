<?php

namespace yax\ShippyProConnector\Models;

class ShippyproAddress{

    public $name, $company, $street1, $street2, $city, $state, $zip, $country, $phone, $email;

    /**
     * Create new ShippyproAddress object
     *
     * @param string $name Name and surname
     * @param string $company Company name
     * @param string $street1 First street address
     * @param string $street2 Second street address
     * @param string $city City
     * @param string $state State
     * @param string $zip Zip code, must be formated as following example "20334" (no dashes)
     * @param string $country Country code
     * @param string $phone Phone number
     * @param string $email Valid email address
     *
     * @return void
     */
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

    /**
     * Convert ShippyproAddress to array
     *
     * @return array Shippypro Address as array
     */
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
