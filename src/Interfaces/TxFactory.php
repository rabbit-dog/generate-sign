<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Interfaces;

use Rabbit\GenerateSign\config\TxEnv;
use Rabbit\GenerateSign\generate\TxGenerate;

class TxFactory implements Factory
{
    public function createEnv(array $config): TxEnv
    {
        return new TxEnv($config);
    }

    public function createSign(): TxGenerate
    {
        return new TxGenerate();
    }
}