<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Interfaces;

/**
 * Interface Factory
 * @package app\components\uploadSign\generate
 */
interface Factory
{
    public function createEnv(array $config);

    public function createSign();
}