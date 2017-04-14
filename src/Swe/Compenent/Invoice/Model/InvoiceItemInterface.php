<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 12/04/2017
 * Time: 00:19
 */

namespace Swe\Compenent\Invoice\Model;

interface InvoiceItemInterface {
    /**
     * Get invoiceItem object.
     *
     * @return string
     */
    public function getObject();

    /**
     * Set invoiceItem object.
     *
     * @param string $object
     */
    public function setObject($object);

    /**
     * Get invoiceItem quantity.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Set invoiceItem quantity.
     *
     * @param int $quantity
     */
    public function setQuantity($quantity);

    /**
     * Get invoiceItem amount.
     *
     * @return decimal
     */
    public function getAmount();

    /**
     * Set invoiceItem amount.
     *
     * @param decimal $amount
     */
    public function setAmount($amount);

    /**
     * Get invoice designation.
     *
     * @return string
     */
    public function getInvoice();
    /**
     * Set invoice designation.
     *
     */

    public function setInvoice($invoice);


}