<?php


namespace Swe\Compenent\Core\Model;
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 24/03/2017
 * Time: 12:42
 */

interface OrganismInterface {

    /**
     * Get organism name.
     *
     * @return string
     */
    public function getName();
    /**
     * Set organism name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get organism rib.
     *
     * @return string
     */
    public function getRib();
    /**
     * Set organism rib.
     *
     * @param string $rib
     */
    public function setRib($rib);

    /**
     * Get organism bank.
     *
     * @return string
     */
    public function getBank();
    /**
     * Set organism bank.
     *
     * @param string $bank
     */
    public function setBank($bank);

    /**
     * Get organism agency.
     *
     * @return string
     */
    public function getAgency();
    /**
     * Set organism agency.
     *
     * @param string $agency
     */
    public function setAgency($agency);
}