<?php

namespace TelrGateway;

use Illuminate\Database\Eloquent\Model;

class TelrURL extends Model
{
    /**
     * @var string
     */
    protected $telrURL;

    /**
     * TelrURL constructor.
     *
     * @param array $url
     */
    public function __construct($url)
    {
        $this->telrURL = $url;
    }

    /**
     * Redirect response to telr URL
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return redirect()->to($this->telrURL);
    }

    /**
     * Get the redirect URL
     *
     * @return string
     */
    public function redirectURL()
    {
        return $this->telrURL;
    }
}