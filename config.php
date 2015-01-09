<?php
use Pimple\Container;

$container = new Container();

$container['client'] = function($container) {
    return new Goutte\Client;
};
$container['api'] = function($container) {
    return new Amazon\Api($container['client']);
};
$container['model'] = function($container) {
    return new Amazon\Model($container['api']);
};
