<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 07/04/2017
 * Time: 17:36
 */

namespace Swe\Compenent\Consulting\Model;

use Swe\Compenent\Core\Model\Patient;
use Swe\Compenent\Core\Model\PatientInterface;

class ConsultingPatient extends Patient implements PatientInterface
{
    /**
     * ConsultingPatient consultationMotif.
     *
     * @var mixed
     */
    private $consultationMotif;
    /**
     * ConsultingPatient histoireClinique.
     *
     * @var string
     */
    private $histoireClinique;
    /**
     * ConsultingPatient diagnostic.
     *
     * @var string
     */
    private $diagnostic;

    /**
     * {@inheritdoc}
     */
    public function getConsultationMotif() {
        return $this->consultationMotif;
    }

    /**
     * {@inheritdoc}
     */
    public function setConsultationMotif($consultationMotif) {
        $this->consultationMotif = $consultationMotif;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoireClinique() {
        return $this->histoireClinique;
    }

    /**
     * {@inheritdoc}
     */
    public function setHistoireClinique($histoireClinique) {
        $this->histoireClinique = $histoireClinique;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getDiagnostic() {
        return $this->diagnostic;
    }

    /**
     * {@inheritdoc}
     */
    public function setDiagnostic($diagnostic) {
        $this->diagnostic = $diagnostic;
        return $this;
    }


}