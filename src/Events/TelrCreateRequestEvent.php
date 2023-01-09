<?php

namespace Mubarakismail\TelrPayment\Events;

use Mubarakismail\TelrPayment\CreateTelrRequest;

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
     * @param \Mubarakismail\TelrPayment\CreateTelrRequest $request
     * @param \stdClass $response
     */
    public function __construct(CreateTelrRequest $request, \stdClass $response)
    {
        $this->telrRequest = $request;
        $this->response = $response;
    }
}
