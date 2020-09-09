<?php

namespace TelrGateway;

use Illuminate\Contracts\Support\Arrayable;
use Ramsey\Uuid\Uuid;
use Arr;
use Str;

class CreateTelrRequest extends AbstractTelrRequest implements Arrayable
{
    /**
     * CreateTelrRequest constructor.
     *
     * @param $orderId
     * @param $amount
     */
    public function __construct($orderId, $amount)
    {
        $this->setOrderId($orderId);
        $this->setAmount($amount);
        $this->setCartId(Uuid::uuid4()->toString().'-'.time());
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return data_get($this->data, 'order_id');
    }

    /**
     * @param mixed $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->data['order_id'] = $orderId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return data_get($this->data, 'ivp_cart', null);
    }

    /**
     * @param $orderId
     * @return $this
     */
    public function setCartId($orderId)
    {
        $this->data['ivp_cart'] = $orderId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return data_get($this->data, 'ivp_amount', null);
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->data['ivp_amount'] = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return data_get($this->data, 'ivp_currency', config('telr.currency'));
    }

    /**
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->data['ivp_currency'] = $currency;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return Arr::has($this->data, 'ivp_desc') ? Str::limit($this->data['ivp_desc'], 60, '...') : null;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDesc($description)
    {
        $this->data['ivp_desc'] = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessURL()
    {
        return $this->appendOrderIdToURL(config('telr.create.return_auth'), $this->getCartId());
    }

    /**
     * @param $returnAuthURL
     * @return $this
     */
    public function setSuccessURL($returnAuthURL)
    {
        $this->data['return_auth'] = $returnAuthURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCancelURL()
    {
        return $this->appendOrderIdToURL(config('telr.create.return_can'), $this->getCartId());
    }

    /**
     * @param $returnCancelURL
     * @return $this
     */
    public function setCancelURL($returnCancelURL)
    {
        $this->data['return_can'] = $returnCancelURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeclinedURL()
    {
        return $this->appendOrderIdToURL(config('telr.create.return_decl'), $this->getCartId());
    }

    /**
     * @param $returnDeclinedURL
     * @return $this
     */
    public function setDeclinedURL($returnDeclinedURL)
    {
        $this->data['return_decl'] = $returnDeclinedURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingFirstName()
    {
        return data_get($this->data, 'bill_fname', null);
    }

    /**
     * @param $firstName
     * @return $this
     */
    public function setBillingFirstName($firstName)
    {
        $this->data['bill_fname'] = $firstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingSurName()
    {
        return data_get($this->data, 'bill_sname', null);
    }

    /**
     * @param $surName
     * @return $this
     */
    public function setBillingSurName($surName)
    {
        $this->data['bill_sname'] = $surName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress1()
    {
        return data_get($this->data, 'bill_addr1', null);
    }

    /**
     * @param $address
     * @return $this
     */
    public function setBillingAddress1($address)
    {
        $this->data['bill_addr1'] = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress2()
    {
        return data_get($this->data, 'bill_addr2', null);
    }

    /**
     * @param $address
     * @return $this
     */
    public function setBillingAddress2($address)
    {
        $this->data['bill_addr2'] = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingCity()
    {
        return data_get($this->data, 'bill_city', null);
    }

    /**
     * @param $city
     * @return $this
     */
    public function setBillingCity($city)
    {
        $this->data['bill_city'] = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingRegion()
    {
        return data_get($this->data, 'bill_region', null);
    }

    /**
     * @param $region
     * @return $this
     */
    public function setBillingRegion($region)
    {
        $this->data['bill_region'] = $region;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingZip()
    {
        return data_get($this->data, 'bill_zip', null);
    }

    /**
     * @param $zip
     * @return $this
     */
    public function setBillingZip($zip)
    {
        $this->data['bill_zip'] = $zip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingCountry()
    {
        return data_get($this->data, 'bill_country', null);
    }

    /**
     * @param $country
     * @return $this
     */
    public function setBillingCountry($country)
    {
        $this->data['bill_country'] = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingEmail()
    {
        return data_get($this->data, 'bill_email', null);
    }

    /**
     * @param $email
     * @return $this
     */
    public function setBillingEmail($email)
    {
        $this->data['bill_email'] = $email;

        return $this;
    }

    /**
     * Set billing lang
     *
     * @param $lang
     * @return $this
     */
    public function setLangCode($lang)
    {
        $this->data['ivp_lang'] = $lang;

        return $this;
    }

    /**
     * Get billing lang
     *
     * @return string|null
     */
    public function getLangCode()
    {
        return data_get($this->data, 'ivp_lang', null);
    }

    /**
     * Append order id to URL
     *
     * @param $url
     * @param $orderId
     * @return string
     */
    protected function appendOrderIdToURL($url, $orderId)
    {
        $url = url($url);
        $query = parse_url($url, PHP_URL_QUERY);

        return $url .= ($query ? '&' : '?')."cart_id={$orderId}";
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'ivp_method' => $this->getMethod(),
            'ivp_store' => $this->getStoreId(),
            'ivp_authkey' => $this->getAuthkey(),
            'ivp_cart' => $this->getCartId(),
            'ivp_test' => $this->isTestMode(),
            'ivp_amount' => $this->getAmount(),
            'ivp_currency' => $this->getCurrency(),
            'ivp_desc' => $this->getDesc(),
            'ivp_lang' => $this->getLangCode(),
            'return_auth' => $this->getSuccessURL(),
            'return_can' => $this->getCancelURL(),
            'return_decl' => $this->getDeclinedURL(),
            'bill_fname' => $this->getBillingFirstName(),
            'bill_sname' => $this->getBillingSurName(),
            'bill_addr1' => $this->getBillingAddress1(),
            'bill_addr2' => $this->getBillingAddress2(),
            'bill_city' => $this->getBillingCity(),
            'bill_region' => $this->getBillingRegion(),
            'bill_zip' => $this->getBillingZip(),
            'bill_country' => $this->getBillingCountry(),
            'bill_email' => $this->getBillingEmail(),
        ];
    }
}
