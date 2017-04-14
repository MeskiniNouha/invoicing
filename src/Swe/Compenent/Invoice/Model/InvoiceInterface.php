<?php

namespace Swe\Compenent\Invoice\Model;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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


    /**
     * Get invoice state.
     *
     * @return string
     */
    public function getState();

    /**
     * Set invoice state.
     *
     * @param string $state
     */
    public function setState($state);

    /**
     * Get invoice invoiceItems.
     *
     * @return Collection
     */

    public function getInvoiceItems();


    public function setInvoiceItems(Collection $invoiceItems);


    public function hasInvoiceItems();


    public function addInvoiceItem(InvoiceItemInterface $invoiceItem);


    public function removeInvoiceItem(InvoiceItemInterface $invoiceItem);


    public function hasInvoiceItem(InvoiceItemInterface $invoiceItem);
}