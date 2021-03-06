<?php

namespace credy\api\v3;

/**
 * Interface ICustomerRequestBuilder
 * @package credy\api\v3
 */
interface ICustomerRequestBuilder
{
    /**
     * @return array
     */
    public function buildRequestData();

    /**
     * @return integer
     */
    public function getTimestamp();
}
