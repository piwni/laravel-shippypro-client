Shippypro Connector
=======================

Shippypro connector is a simply PHP library that allow to integrate Laravel project with Shippypro system.
You can check Carrier Rates, and Ship orders.

First you have to publis configuration. Execute command
```php
    php artisan vendor:publish
```
After that you have to configure your Shippypro API key in config/shippypro.php
```php
    /* This example use env file but you can past in this place your API key */
    'api_key' => env('SHIPPYPRO_API', null),
```

Add folowing line to config/app.php to providers array

```php
'providers' => [
    ...
    \yax\ShippyProConnector\ShippyproServiceProvider::class
],
```


This is example integration
```php
$sender = new ShippyproAddress('Jan Kowalski', '/', 'Prosta 20', '/', 'Wrocław', 'DS', '50-419', 'PL', '445544544', 'jankowalski@gmail.com');
$recivier = new ShippyproAddress('Jan Kowalski', '/', 'Prosta 20', '/', 'Wrocław', 'DS', '50-419', 'PL', '445544544', 'jankowalski@gmail.com');
$parcel = new ShippyproParcel('30', '20', '20', '10');
$shipment = new ShippyproShipment(30.00, 'Description');
$shipment->to_address($recivier);
$shipment->from_address($sender);
$shipment->addParcel($parcel);
$array = $shipment->getRates();
$rate = $array->searchByKey('carrier_id', 1081);
$shipment->setTransactionId(2349);
if ($rate) {
    $shipment->setRate($rate);
    $order = $shipment->purchase();
}
```
