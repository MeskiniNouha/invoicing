<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 24/03/2017
 * Time: 12:47
 */

namespace Swe\Compenent\Core\Model;


use Swe\Compenent\Core\Model\OrganismInterface;

class Organism implements OrganismInterface
{

    /**
     * Organism id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Organism name.
     *
     * @var string
     */
    protected $name;

    /**
     * Organism rib.
     *
     * @var string
     */
    protected $rib;

    /**
     * Organism bank.
     *
     * @var string
     */
    protected $bank;

    /**
     * Organism agency.
     *
     * @var string
     */
    protected $agency;

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRib() {
        return $this->rib;
    }

    /**
     * {@inheritdoc}
     */
    public function setRib($rib) {
        $this->rib = $rib;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBank() {
        return $this->bank;
    }

    /**
     * {@inheritdoc}
     */
    public function setBank($bank) {
        $this->bank = $bank;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAgency() {
        return $this->agency;
    }

    /**
     * {@inheritdoc}
     */
    public function setAgency($agency) {
        $this->agency = $agency;
        return $this;
    }

}