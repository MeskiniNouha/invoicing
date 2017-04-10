<?php

namespace Swe\Compenent\Core\Model;
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 24/03/2017
 * Time: 13:56
 */

interface PatientInterface {

    /**
     * Get patient firstName.
     *
     * @return string
     */
    public function getFirstName();
    /**
     * Set patient firstName.
     *
     * @param string $firstName
     */
    public function setFirstName($firstName);

    /**
     * Get patient lastName.
     *
     * @return string
     */
    public function getLastName();
    /**
     * Set patient lastName.
     *
     * @param string $lastName
     */
    public function setLastName($lastName);

    /**
     * Get patient cin.
     *
     * @return string
     */
    public function getCin();
    /**
     * Set patient cin.
     *
     * @param string $cin
     */
    public function setCin($cin);
    /**
     * Get patient organism.
     *
     * @return string
     */
    public function getOrganism();

    /**
     * Set patient organism.
     *
     * @param string $organism
     */

    public function setOrganism($organism);

}