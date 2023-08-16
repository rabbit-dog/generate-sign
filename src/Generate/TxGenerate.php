<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Generate;

/**
 * Class TxGenerate
 * @package app\components\uploadSign\generate
 */
class TxGenerate implements Factory
{
    /**
     * @param array $env
     * @return string
     * @throws \Exception
     */
    public function generate(array $env)
    {
        try {
            extract($env);
            /**
             * @var $secret_key
             */
            unset($env['secret_key']);
            return base64_encode(hash_hmac('SHA1', $original = http_build_query($env), (string)$secret_key, true) . $original);
        } catch (\Exception $exception) {
            throw new \Exception('密钥加密异常');
        }

    }
}
