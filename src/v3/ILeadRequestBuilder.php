<?php

namespace credy\api\v3;

/**
 * Interface ILeadRequestBuilder
 * @package credy\api\v3
 */
interface ILeadRequestBuilder
{
    /**
     * @return string
     */
    public function getCustomerId();

    /**
     * @return string
     */
    public function getIp();

    /**
     * @return array
     */
    public function buildRequestData();

    /**
     * @return integer
     */
    public function getTimestamp();
}
