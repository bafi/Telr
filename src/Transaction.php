<?php

namespace TelrGateway;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cart_id';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'response' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'order_id',
        'test_mode',
        'store_id',
        'amount',
        'description',
        'success_url',
        'canceled_url',
        'declined_url',
        'billing_fname',
        'billing_sname',
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_region',
        'billing_zip',
        'billing_country',
        'billing_email',
        'lang_code',
        'trx_reference',
        'approved',
        'response',
        'status',
    ];

    /**
     * Approve the transaction
     */
    public function approve()
    {
        $this->fill(['approved' => 1])->save();
    }

    /**
     * Fail the transaction
     */
    public function failed()
    {
        $this->fill(['approved' => 0])->save();
    }

    /**
     * Check it transaction got approved
     *
     * @return bool
     */
    public function isApproved()
    {
        return (bool) $this->approved;
    }

    /**
     * Check if transaction got failed
     *
     * @return bool
     */
    public function isFailed()
    {
        return ! $this->isApproved();
    }
}