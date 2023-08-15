<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Generate;

/**
 * Interface Factory
 * @package app\components\uploadSign\generate
 */
interface Factory {
    public function generate(array $msg);
}