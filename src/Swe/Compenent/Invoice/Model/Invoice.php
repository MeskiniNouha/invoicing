<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 24/03/2017
 * Time: 15:12
 */

namespace Swe\Compenent\Invoice\Model;
use Swe\Compenent\Invoice\Model\InvoiceInterface;
use Swe\Compenent\Core\Model\Patient;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



class Invoice implements InvoiceInterface
{
    /**
     * Invoice id.
     *
     * @var mixed
     */
    protected $id;
    /**
     * Invoice dateInvoicing.
     *
     * @var \DateTime
     */

    protected $dateInvoicing;
    /**
     * Invoice designation.
     *
     * @var string
     */

    protected $designation;

    /**
     * Invoice amount.
     *
     * @var string
     */
    protected $amount;

    /**
     * Invoice patient.
     *
     * @var Patient
     */
    protected $patient;

    /**
     * Invoice state.
     *
     * @var string
     */
    protected $state;


    /**
     * Invoice invoiceItems.
     *
     * @var Collection |InvoiceItemInterface[]
     */

    protected $invoiceItems;

    public function __construct()
    {
        $this->invoiceItems = new ArrayCollection();
        $this->state = 'onDraft';
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getDateInvoicing()
    {
        return $this->dateInvoicing;
    }

    /**
     * {@inheritdoc}
     */
    public function setDateInvoicing($dateInvoicing)
    {
        $this->dateInvoicing = $dateInvoicing;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDesignation()
    {
        return $this->designation;
    }
    /**
     * {@inheritdoc}
     */

    public function setDesignation($designation)
    {
        $this->designation = $designation;

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
    public function getPatient() {
        return $this->patient;
    }

    /**
     * {@inheritdoc}
     */
    public function setPatient($patient) {
        $this->patient = $patient;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function getInvoiceItems() {
        return $this->invoiceItems;
    }

    /**
     * {@inheritdoc}
     */
    public function setInvoiceItems(Collection $invoiceItems)
    {
        $this->invoiceItems = $invoiceItems;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasInvoiceItems()
    {
        return !$this->invoiceItems->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function addInvoiceItem(InvoiceItemInterface $invoiceItem)
    {
        if (!$this->hasInvoiceItems($invoiceItem)) {
            $this->invoiceItems->add($invoiceItem);
            $invoiceItem->setInvoice($this);
        }

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function removeInvoiceItem(InvoiceItemInterface $invoiceItem)
    {
        if ($this->hasInvoiceItems($invoiceItem)) {
            $this->invoiceItems->removeElement($invoiceItem);
            $invoiceItem->setInvoice(null);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasInvoiceItem(InvoiceItemInterface $invoiceItem)
    {
        return $this->invoiceItems->contains($invoiceItem);
    }


}