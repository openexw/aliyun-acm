<?php


namespace AliyunAcm\Configuration;


use AliyunAcm\Kernel\BaseClient;
use \Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    const DEFAULT_GROUP = 'DEFAULT_GROUP';
    private $signature;

    private $timestamp;

    /**
     * @return mixed
     */
    public function getAccessKey()
    {
        return $this->app->config->get('access_key');
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->app->config->get('secret_key');
    }


    /**
     * @param string $tenant
     * @param string $dataId
     * @param string $group
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see https://help.aliyun.com/document_detail/64131.html?spm=a2c4g.11186623.6.587.6b21e54ad8STyQ
     */
    public function getConfig(string $tenant, string $dataId, string $group = self::DEFAULT_GROUP): ResponseInterface
    {
        $this->buildSignature("{$tenant}+{$group}");
        return $this->httpGet('/diamond-server/config.co', ['tenant' => $tenant, 'dataId' => $dataId, 'group' => $group]);
    }

    /**
     * @see https://help.aliyun.com/document_detail/69590.html?spm=a2c4g.11186623.6.586.24616652WfbbPn
     * @param string $tenant
     * @param int $pageNo
     * @param int $pageSize
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllConfigByTenant(string $tenant, int $pageNo = 1, int $pageSize = 10)
    {
        $this->buildSignature($tenant);
        return $this->httpGet('/diamond-server/basestone.do?method=getAllConfigByTenant', ['tenant' => $tenant, 'pageNo' => $pageNo, 'pageSize' => $pageSize]);
    }


    /**
     * @see https://help.aliyun.com/document_detail/69307.html?spm=a2c4g.11186623.6.589.2f293c53RZTmwK
     */
    public function syncUpdateAll()
    {
        // /diamond-server/basestone.do
    }

    /**
     * @see https://help.aliyun.com/document_detail/69308.html?spm=a2c4g.11186623.6.590.7a0a28447hzEda
     */
    public function deleteAllDatums()
    {

    }

    /**
     * @param string $sign
     */
    public function buildSignature(string $sign)
    {
        $this->timestamp = microtime(true) * 1000;
        $this->signature = hash_hmac('sha1', $sign . '+' . $this->timestamp, $this->getSecretKey());
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function aliRequest(string $url, string $method, array $options = [])
    {
        $aliHeaders = [
            'Spas-AccessKey' => $this->getAccessKey(),
            'timeStamp' => $this->timestamp,
            'Spas-Signature' => $this->signature
        ];
        if (isset($options['headers'])) {
            $options['headers'] = array_merge($options['headers'], $aliHeaders);
        } else {
            $options['headers'] = $aliHeaders;
        }
        return $this->request($url, $method, $options);
    }

    /**
     * @param string $url
     * @param array $query
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpGet(string $url, array $query = [])
    {
        return $this->aliRequest($url, 'GET', ['query' => $query]);
    }

    /**
     * @param string $url
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPost(string $url, array $data = [])
    {
        return $this->aliRequest($url, 'POST', ['form_params' => $data]);
    }
}

