<?php

namespace TelrGateway;

Abstract class AbstractTelrRequest
{
    protected $data;

    /**
     * Get the end point URL
     *
     * @return mixed
     */
    public function getEndPointURL()
    {
        return config('telr.sale.endpoint');
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return data_get($this->data, 'ivp_method', config('telr.create.ivp_method'));
    }

    /**
     * @param $ivp_method
     * @return $this
     */
    public function setMethod($ivp_method)
    {
        $this->data['ivp_method'] = $ivp_method;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoreId()
    {
        return config('telr.create.ivp_store');
    }

    /**
     * @param $ivp_store
     * @return $this
     */
    public function setStoreId($ivp_store)
    {
        $this->data['ivp_store'] = $ivp_store;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthkey()
    {
        return config('telr.create.ivp_authkey');
    }

    /**
     * @param $ivp_authkey
     * @return $this
     */
    public function setAuthkey($ivp_authkey)
    {
        $this->data['ivp_authkey'] = $ivp_authkey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function isTestMode()
    {
        return data_get($this->data, 'ivp_test', config('telr.test_mode'));
    }

    /**
     * @param $ivp_test
     * @return $this
     */
    public function setTestMode($ivp_test)
    {
        $this->data['ivp_test'] = $ivp_test;

        return $this;
    }
}