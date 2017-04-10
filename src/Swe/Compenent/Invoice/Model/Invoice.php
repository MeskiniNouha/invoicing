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





}