<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Config;

use \Exception;

/**
 * Class TxEnv
 */
class TxEnv extends Base
{
    const VOD_SUB_APPID = '应用ID';
    /**
     * @var int $secretId
     * 云 API 密钥中的 SecretId，获取方式请参见 客户端上传指引 - 获取云 API 密钥
     */
    protected $secretId = 'SecretId';
    /**
     * @var int $secretKey
     * 获取调用服务端 API 所需的安全凭证
     */
    protected $secretKey = 'secretKey';
    /**
     * @var int $expireTime
     * 签名到期 Unix 时间戳。
     */
    protected $expireTime = 86400;
    /**
     * @var int $oneTimeValid
     * 签名是否单次有效，详细请参见 客户端上传指引 - 单次有效签名。
     * 默认为0，表示不启用；1表示签名单次有效。
     * 相关错误码详见 单次有效签名说明。
     */
    protected $oneTimeValid = 0;
    /**
     * @var string
     * Finish：只有当任务流全部执行完毕时，才发起一次事件通知。
     * Change：只要任务流中每个子任务的状态发生变化，都进行事件通知。
     * None：不接受该任务流回调。
     */
    protected $taskNotifyMode = 'Finish';
    /**
     * @var int
     * 视频文件分类，默认为0。
     */
    protected $classId = 0;

    /**
     * @var int
     * 视频后续任务优先级（仅当指定了 procedure 时才有效），取值范围为[-10，10]，默认为0。
     */
    protected $taskPriority = 0;
    /**
     * @var int
     * 来源上下文，用于透传用户请求信息，上传完成回调 将返回该字段值，最长250个字符。
     */
    protected $sourceContext = '';
    /**
     * @var int
     * 子应用 ID，如果不填写、填写0或填写开发者的腾讯云 AppId，则操作的子应用为“主应用”。
     */
    protected $vodSubAppId = self::VOD_SUB_APPID;
    /**
     * @var int
     * 会话上下文，用于透传用户请求信息，当指定 procedure 参数后，任务流状态变更回调 将返回该字段值，最长 1000 个字符。
     */
    protected $sessionContext = '';
    /**
     * @var int
     * 指定存储地域，可以在控制台上自助添加存储地域，详细请参见 上传存储设置，该字段填写为存储地域的 英文简称。
     */
    protected $storageRegion = '';

    /**
     * @var string
     * 视频后续任务处理操作，即完成视频上传后，可自动发起任务流操作。参数值为任务流模板名，云点播支持 创建任务流模板 并为模板命名。
     */
    protected $procedure = 'tao_hls';

    /**
     * @return array
     * @throws \Exception
     */
    public function getEnv()
    {
        try {
            return [
                'secretId'         => $this->secretId,
                'secret_key'       => $this->secretKey,
                'currentTimeStamp' => $t = time(),
                'random'           => rand(),
                'expireTime'       => $t + $this->expireTime,
                'procedure'        => $this->procedure,
                'oneTimeValid'     => $this->oneTimeValid,
                'taskNotifyMode'   => $this->taskNotifyMode,
                'classId'          => $this->classId,
                'taskPriority'     => $this->taskPriority,
                'vodSubAppId'      => $this->vodSubAppId,
                'sourceContext'    => $this->sourceContext,
                'sessionContext'   => $this->sessionContext,
                'storageRegion'    => $this->storageRegion,
            ]+ $this->dynamicState();
        } catch (Exception $e) {
            throw new \Exception('密钥配置异常');
        }
    }
}
