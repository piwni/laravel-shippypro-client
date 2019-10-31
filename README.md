Shippypro Connector
=======================

Shippypro connector is a simple PHP library that allows to integrate Shippypro into your project.
You can check carrier rates and ship orders.

First you have to publish configuration. Execute command
```php
    php artisan vendor:publish
```
After that you have to configure your Shippypro API key in config/shippypro.php
```php
    /* This example uses env file but you can paste in this place your API key */
    'api_key' => env('SHIPPYPRO_API', null),
```

Add folowing line to config/app.php to providers array

```php
'providers' => [
    ...
    \yax\ShippyProConnector\ShippyproServiceProvider::class
],
```


This is an example integration
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
