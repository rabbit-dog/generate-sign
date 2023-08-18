<?php declare(strict_types=1);

namespace Rabbit\GenerateSign\Config;

use \Exception;

/**
 * Class TxEnv
 */
class TxPlayEnv extends Base
{
    /**
     * @var int $appId
     * 点播应用 appId。
     */
    protected $appId = '$appId';

    /**
     * @var int $fileId
     * 点播文件 ID。
     */
    protected $fileId = '$fileId';

    /**
     * @var object $contentInfo
     * 对应点播文件 ID 播放的具体内容，为 ContentInfo 类型，可播放下列三种中的一种：
     * 转自适应码流 的输出音视频，可以是未加密或加密的。
     * 转码 的输出音视频。
     * 上传 的原始音视频。
     */
    protected $contentInfo = [];

    /**
     * @var int $currentTimeStamp
     * 派发签名当前 Unix 时间戳。
     */
    protected $currentTimeStamp = 0;
    /**
     * @var int $expireTimeStamp
     * 派发签名到期 Unix 时间戳，不填表示不过期。
     */
    protected $expireTimeStamp = '';
    /**
     * @var int $urlAccessInfo
     * 播放链接访问配置参数，包括 Key 防盗链 配置、播放域名与协议参数，为 UrlAccessInfo 类型。
     */
    protected $urlAccessInfo = 0;

    /**
     * @var int $drmLicenseInfo
     * DRM License 配置参数，为 DrmLicenseInfo 类型 。
     */
    protected $drmLicenseInfo = 0;
    /**
     * @var int $ghostWatermarkInfo
     * 幽灵水印参数配置，为 GhostWatermarkInfo 类型。
     */
    protected $ghostWatermarkInfo = '';

    /**
     * @return array
     * @throws \Exception
     */
    public function getEnv()
    {
        try {
            return [
                       'appId'              => $this->appId,
                       'fileId'             => $this->fileId,
                       'contentInfo'        => $this->contentInfo,
                       'currentTimeStamp'   => $t = time(),
                       'urlAccessInfo'      => $this->urlAccessInfo,
                       'drmLicenseInfo'     => $this->drmLicenseInfo,
                       'ghostWatermarkInfo' => $this->ghostWatermarkInfo,
                   ] + $this->dynamicState($this->acquisitionDynamics());
        } catch (Exception $e) {
            throw new \Exception('密钥配置异常');
        }
    }

    /**
     * @return array
     */
    public function acquisitionDynamics(): array
    {
        return ['expireTimeStamp', 'urlAccessInfo', 'drmLicenseInfo', 'ghostWatermarkInfo'];
    }
}
