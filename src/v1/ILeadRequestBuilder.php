<?php

namespace credy\api\v1;

/**
 * Interface ILeadRequestBuilder
 * @package credy\api\v1
 */
interface ILeadRequestBuilder
{
    /**
     * @return array
     */
    public function buildRequestData();
}
