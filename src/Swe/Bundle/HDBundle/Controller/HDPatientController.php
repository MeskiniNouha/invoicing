<?php

namespace Swe\Bundle\HDBundle\Controller;

use Swe\Compenent\HD\Model\HDPatient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HDPatientController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $HDpatients = $em->getRepository('Swe\Compenent\HD\Model\HDPatient')->findAll();

        return $this->render('SweHDBundle:HDPatient:index.html.twig', array(
            'patients' => $HDpatients,
        ));
    }


    public function newAction(Request $request)
    {
        $patient = new HDPatient();
        $form = $this->createForm('Swe\Bundle\HDBundle\Form\HDPatientType', $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush($patient);

            return $this->redirectToRoute('Swe_HDpatient_show', array('id' => $patient->getId()));
        }

        return $this->render('SweHDBundle:HDPatient:new.html.twig', array(
            'patient' => $patient,
            'form' => $form->createView(),
        ));
    }

    public function showAction(HDPatient $patient)
    {
        $deleteForm = $this->createDeleteForm($patient);

        return $this->render('SweHDBundle:HDPatient:show.html.twig', array(
            'patient' => $patient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, HDPatient $patient)
    {
        $deleteForm = $this->createDeleteForm($patient);
        $editForm = $this->createForm('Swe\Bundle\HDBundle\Form\HDPatientType', $patient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Swe_HDpatient_edit', array('id' => $patient->getId()));
        }

        return $this->render('SweHDBundle:HDPatient:edit.html.twig', array(
            'patient' => $patient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, HDPatient $patient)
    {
        $form = $this->createDeleteForm($patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($patient);
            $em->flush();
        }

        return $this->redirectToRoute('Swe_HDpatient_homepage');
    }


    private function createDeleteForm(HDPatient $patient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Swe_HDpatient_delete', array('id' => $patient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
