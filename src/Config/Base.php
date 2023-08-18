<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Config;

class Base implements Sign
{
    /**
     * Base constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        array_walk($config, function ($value, $key) {
            !is_null($this->$key) && $this->$key = $value;
        });
    }

    /**
     * @param array $release
     * @param array $callback
     * @return array
     */
    public function dynamicState($release = ['sessionContext', 'storageRegion'], $callback = [])
    {
        array_walk($release, function ($value, $key) use (&$callback) {
            if ($this->$value != '') {
                $callback = array_merge([$value => $this->$value] + $callback);
            }
        });

        return $callback;
    }

    /**
     * @return array
     */
    public function getEnv()
    {
        return [];
    }
}
