<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 07/04/2017
 * Time: 17:36
 */

namespace Swe\Compenent\HD\Model;

use Swe\Compenent\Core\Model\Patient;
use Swe\Compenent\Core\Model\PatientInterface;

class HDPatient extends Patient implements PatientInterface
{
    /**
     * ConsultingPatient technique.
     *
     * @var mixed
     */
    private $technique;
    /**
     * ConsultingPatient module.
     *
     * @var string
     */
    private $module;
    /**
     * ConsultingPatient line.
     *
     * @var string
     */
    private $line;

    /**
     * {@inheritdoc}
     */
    public function getTechnique() {
        return $this->technique;
    }

    /**
     * {@inheritdoc}
     */
    public function setTechnique($technique) {
        $this->technique = $technique;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * {@inheritdoc}
     */
    public function setModule($module) {
        $this->module = $module;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getLine() {
        return $this->line;
    }

    /**
     * {@inheritdoc}
     */
    public function setLine($line) {
        $this->line = $line;
        return $this;
    }


}