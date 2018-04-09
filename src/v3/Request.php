<?php

namespace credy\api\v3;

use yii\base\Component;

/**
 * Class Request
 * @package credy\api\v3
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
