<?php


use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Delivery\OrderDeliveryAddress;
use RetailCrm\Api\Model\Entity\Orders\Delivery\SerializedOrderDelivery;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Entity\Orders\Payment;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$apiUrl = 'https://demo.retailcrm.ru';
$apiKey = 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb';

$client = SimpleClientFactory::createClient($apiUrl, $apiKey);

$request = new OrdersCreateRequest();
$order = new Order();
$payment = new Payment();
$delivery = new SerializedOrderDelivery();
$deliveryAddress = new OrderDeliveryAddress();
$offer = new Offer();
$item = new OrderProduct();


$offer->name = 'Маникюрный набор AZ105R Azalita';
$offer->article = 'AZ105R-Azalita';

$item->offer = $offer;

$order->status = 'trouble';
$order->items = [$item];
$order->number = '29031996';
$order->orderType = 'fizik';
$order->orderMethod = 'test';
$order->firstName = 'FirstName';
$order->lastName = 'LastName';
$order->patronymic = 'Patronymic';
$order->customer['site'] = 'test';
$order->customerComment = 'https://github.com/Archi2903/RetailCRMtest';
$order->customFields = [
    "prim" => 'https://docs.google.com/document/d/1coPXabBsKyVpKs9Qmf-P5rNpGoOw8Rf3k94YgiK7Xj8/edit',
];

$request->order = $order;
$request->site = 'test';


try {
    $response = $client->orders->create($request);
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception;
    exit(-1);
}

echo "<pre>";
var_dump($response->id);
echo "</pre>";