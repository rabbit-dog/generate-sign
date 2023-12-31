<?php declare(strict_types=1);

namespace Rabbit\GenerateSign;

use Rabbit\GenerateSign\Interfaces\TxFactory;

/**
 * Class factory
 * @package app\components\uploadSign
 */
class Factory
{
    /**
     * @param array $config
     * @return string
     * @throws \Exception
     */
    public function __invoke(array $config = [])
    {
        try {
            $factory = new TxFactory();
            $env     = $factory->createEnv($config)->getEnv();

            return $factory->createSign()->generate($env);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param array $config
     * @return string
     * @throws \Exception
     */
    public function playKey(array $config = [])
    {
        try {
            $factory = new TxFactory();
            $env     = $factory->createPlayEnv($config)->getEnv();

            return jwt.encode($env, PlayKey, algorithm='HS256');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}