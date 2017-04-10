<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 07/04/2017
 * Time: 17:36
 */

namespace Swe\Compenent\Core\Model;

class Patient
{
    /**
     * ConsultingPatient id.
     *
     * @var mixed
     */
    protected $id;
    /**
     * ConsultingPatient firstName.
     *
     * @var string
     */
    protected $firstName;
    /**
     * ConsultingPatient lastName.
     *
     * @var string
     */
    protected $lastName;
    /**
     * ConsultingPatient cin.
     *
     * @var string
     */
    protected $cin;

    /**
     * ConsultingPatient organism.
     *
     * @var Organism
     */
    protected $organism;

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getCin() {
        return $this->cin;
    }

    /**
     * {@inheritdoc}
     */
    public function setCin($cin) {
        $this->cin = $cin;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganism() {
        return $this->organism;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrganism($organism) {
        $this->organism = $organism;
        return $this;
    }

}