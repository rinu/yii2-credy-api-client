<?php

namespace credy\api;

use yii\base\Component;

/**
 * Class Request
 * @package credy\api
 */
class Request extends Component
{
    /**
     * @param string $apiKey
     * @param string $secretKey
     * @return string
     */
    public function createSignature($apiKey, $secretKey)
    {
        return sha1(time() . $apiKey . $secretKey);
    }
}
