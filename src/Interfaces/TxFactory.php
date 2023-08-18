<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Interfaces;

use Rabbit\GenerateSign\config\TxEnv;
use Rabbit\GenerateSign\Config\TxPlayEnv;
use Rabbit\GenerateSign\generate\TxGenerate;

class TxFactory implements Factory
{
    /**
     * @param array $config
     * @return TxEnv
     */
    public function createEnv(array $config): TxEnv
    {
        return new TxEnv($config);
    }

    /**
     * @param array $config
     * @return TxPlayEnv
     */
    public function createPlayEnv(array $config): TxPlayEnv
    {
        return new TxPlayEnv($config);
    }

    /**
     * @return TxGenerate
     */
    public function createSign(): TxGenerate
    {
        return new TxGenerate();
    }
}