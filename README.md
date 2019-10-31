Shippypro Connector
=======================

[![Latest Version](https://img.shields.io/github/release/guzzle/guzzle.svg?style=flat-square)](https://github.com/mateusztumatek/smakeShippyPro)

Shippypro connector is a simply PHP library that allow to integrate Laravel project with Shippypro system.
You can check Carrier Rates, and Ship orders.

```php
$sender = new ShippyproAddress('Mateusz Bielak', '/', 'Tadeusza Kościuszki 58', '/', 'Wrocław', 'DS', '50-009', 'PL', '694556711', 'mbielak@ideashirt.pl');
$recivier = new ShippyproAddress('Mateusz Bielak', '/', 'Tadeusza Kościuszki 58', '/', 'Wrocław', 'DS', '50-009', 'PL', '694556711', 'mbielak@ideashirt.pl');
$parcel = new ShippyproParcel('30', '20', '20', '10');
$shipment = new ShippyproShipment(30.00, 'Description');
$shipment->to_address($recivier);
$shipment->from_address($sender);
$shipment->addParcel($parcel);
$array = $shipment->getRates();
$rate = $array->searchByKey('carrier', 'Generic');
$shipment->setTransactionId(2349);
if ($rate) {
    $shipment->setRate($rate);
    $shipment->purchase();
}
```


## Installing Guzzle

The recommended way to install ShippyproConnector is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
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
