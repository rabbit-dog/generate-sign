<?php declare(strict_types=1);

use Rabbit\GenerateSign\Factory;

header('content-type:text/html;charset=utf-8');

include  '../vendor/autoload.php';

try {
    die((new Factory())());
} catch (\Exception $exception) {
    die($exception->getMessage());
}
