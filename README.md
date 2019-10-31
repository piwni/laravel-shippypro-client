Shippypro Connector
=======================

[![Latest Version](https://img.shields.io/github/release/guzzle/guzzle.svg?style=flat-square)](https://github.com/mateusztumatek/smakeShippyPro)

Shippypro connector is a simply PHP library that allow to integrate Laravel project with Shippypro system.
You can check Carrier Rates, and Ship orders.

First you have to publis configuration. Execute command
```php
    php artisan vendor:publish
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

Next, run the Composer command to install the latest stable version of ShippyproConnector:

```bash
composer require mateusztumatek/shippyproconnector
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Guzzle using composer:

 ```bash
composer update
 ```


[guzzle-3-repo]: https://github.com/guzzle/guzzle3
[guzzle-4-repo]: https://github.com/guzzle/guzzle/tree/4.x
[guzzle-5-repo]: https://github.com/guzzle/guzzle/tree/5.3
[guzzle-6-repo]: https://github.com/guzzle/guzzle
[guzzle-3-docs]: http://guzzle3.readthedocs.org
[guzzle-5-docs]: http://guzzle.readthedocs.org/en/5.3/
[guzzle-6-docs]: http://guzzle.readthedocs.org/en/latest/
