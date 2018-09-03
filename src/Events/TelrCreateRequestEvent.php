<?php

namespace payment\telr\Events;

use payment\telr\CreateTelrRequest;

class TelrCreateRequestEvent
{
    /**
     * @var CreateTelrRequest
     */
    public $telrRequest;

    /**
     * @var \stdClass
     */
    public $response;

    /**
     * CreateRequestEvent constructor.
     *
     * @param \payment\telr\CreateTelrRequest $request
     * @param \stdClass $response
     */
    public function __construct(CreateTelrRequest $request, \stdClass $response)
    {
        $this->telrRequest = $request;
        $this->response = $response;
    }
}
