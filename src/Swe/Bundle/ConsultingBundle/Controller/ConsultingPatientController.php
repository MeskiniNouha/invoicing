<?php

namespace Swe\Bundle\ConsultingBundle\Controller;

use Swe\Compenent\Consulting\Model\ConsultingPatient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ConsultingPatientController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Consultingpatients = $em->getRepository('Swe\Compenent\Consulting\Model\ConsultingPatient')->findAll();

        return $this->render('SweConsultingBundle:ConsultingPatient:index.html.twig', array(
            'patients' => $Consultingpatients,
        ));
    }


    public function newAction(Request $request)
    {
        $patient = new ConsultingPatient();
        $form = $this->createForm('Swe\Bundle\ConsultingBundle\Form\ConsultingPatientType', $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush($patient);

            return $this->redirectToRoute('Swe_Consultingpatient_show', array('id' => $patient->getId()));
        }

        return $this->render('SweConsultingBundle:ConsultingPatient:new.html.twig', array(
            'patient' => $patient,
            'form' => $form->createView(),
        ));
    }

    public function showAction(ConsultingPatient $consultingPatient)
    {
        $deleteForm = $this->createDeleteForm($consultingPatient);

        return $this->render('SweConsultingBundle:ConsultingPatient:show.html.twig', array(
            'patient' => $consultingPatient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, ConsultingPatient $consultingPatient)
    {
        $deleteForm = $this->createDeleteForm($consultingPatient);
        $editForm = $this->createForm('Swe\Bundle\ConsultingBundle\Form\ConsultingPatientType', $consultingPatient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Swe_Consultingpatient_edit', array('id' => $consultingPatient->getId()));
        }

        return $this->render('SweConsultingBundle:ConsultingPatient:edit.html.twig', array(
            'patient' => $consultingPatient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, ConsultingPatient $consultingPatient)
    {
        $form = $this->createDeleteForm($consultingPatient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($consultingPatient);
            $em->flush();
        }

        return $this->redirectToRoute('Swe_Consultingpatient_homepage');
    }


    private function createDeleteForm(ConsultingPatient $consultingPatient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Swe_Consultingpatient_delete', array('id' => $consultingPatient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
