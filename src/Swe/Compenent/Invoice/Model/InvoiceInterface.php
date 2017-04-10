<?php

namespace Swe\Compenent\Invoice\Model;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 24/03/2017
 * Time: 15:10
 */

interface InvoiceInterface {

    /**
     * Get invoice dateInvoicing.
     *
     * @var \DateTime
     */
    public function getDateInvoicing();

    /**
     * Set invoice dateInvoicing.
     *
     * @param DateTime $dateInvoicing
     */
    public function setDateInvoicing($dateInvoicing);

    /**
     * Get invoice designation.
     *
     * @return string
     */
    public function getDesignation();

    /**
     * Set invoice designation.
     *
     * @param string $designation
     */
    public function setDesignation($designation);

    /**
     * Get invoice amount.
     *
     * @return decimal
     */
    public function getAmount();

    /**
     * Set invoice amount.
     *
     * @param decimal $amount
     */
    public function setAmount($amount);

    /**
     * Get patient name.
     *
     * @return string
     */
    public function getPatient();
    /**
     * Set patient name.
     *
     */

    public function setPatient($patient);
}