<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 12/04/2017
 * Time: 00:18
 */

namespace Swe\Compenent\Invoice\Model;

use Swe\Compenent\Invoice\Model\Invoice;
use Swe\Compenent\Invoice\Model\InvoiceItemInterface;


class InvoiceItem implements InvoiceItemInterface
{
    /**
     * InvoiceItem id.
     *
     * @var mixed
     */
    protected $id;
    /**
     * InvoiceItem object.
     *
     * @var string
     */

    protected $object;
    /**
     * InvoiceItem quantity.
     *
     * @var string
     */

    protected $quantity;

    /**
     * InvoiceItem amount.
     *
     * @var string
     */
    protected $amount;

    /**
     * InvoiceItem invoice.
     *
     * @var Invoice
     */
    protected $invoice;

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * {@inheritdoc}
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * {@inheritdoc}
     */

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * {@inheritdoc}
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getInvoice() {
        return $this->invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function setInvoice($invoice) {
        $this->invoice = $invoice;
        return $this;
    }

    public function toArray()
    {
        return array(
            'object'   => $this->object,
            'amount'   => $this->amount,
            'quantity'   => $this->quantity,
        );
    }

}