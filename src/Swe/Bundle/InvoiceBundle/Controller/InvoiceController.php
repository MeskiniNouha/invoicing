<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 25/03/2017
 * Time: 23:44
 */

namespace Swe\Bundle\InvoiceBundle\Controller;


use Swe\Compenent\Invoice\Model\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $invoices = $em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->findAll();
        return $this->render('SweInvoiceBundle:Invoice:index.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    public function newAction(Request $request)
    {
        //  $em = $this->getDoctrine()->getRepository('PatientBundle:Patient');
        //// $patients = $em->findAll();
        $invoice = new Invoice();
        $form = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush($invoice);

            return $this->redirectToRoute('Swe_invoice_show', array('id' => $invoice->getId()));
        }

        return $this->render('SweInvoiceBundle:Invoice:new.html.twig', array(
            'invoice' => $invoice,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Invoice $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        return $this->render('SweInvoiceBundle:Invoice:show.html.twig', array(
            'invoice' => $invoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Invoice $invoice)
    {
        //$em = $this->getDoctrine()->getRepository('PatientBundle:Patient');
        //$patients = $em->findAll();
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Swe_invoice_edit', array('id' => $invoice->getId()));
        }

        return $this->render('SweInvoiceBundle:Invoice:edit.html.twig', array(
            'invoice' => $invoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Invoice $invoice)
    {
        $form = $this->createDeleteForm($invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
        }

        return $this->redirectToRoute('Swe_invoice_homepage');
    }

    private function createDeleteForm(Invoice $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Swe_invoice_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function pdfAction($id)
    {
        //$random = random_int(1, 40);
        /* $em = $this->getDoctrine()->getRepository('FactureBundle:Invoice');
         $facture=$em->find($id);
         $now = new \DateTime();
         //$html = $this->renderView('FactureBundle:Facturepdf.html.twig',array('facture'=>$facture));
         $filename = sprintf('/tefhst'.$now->getTimestamp().'.pdf',null,null);
         $this->get('knp_snappy.pdf')->generateFromHtml(
             $this->renderView(
                 'FactureBundle:Invoice:pdf.html.twig',
                 array('facture'=>$facture)
             ),
             "C:/Users/POSTE/Downloads". $filename
         );

         return new Response('', 200, array(
             'X-Sendfile' => $filename,
             'Content-type' => 'Content-Type', 'application/force-download',
             'Content-Disposition' => sprintf('attachment; filename="%s"', $filename))
         );*/
        $em = $this->getDoctrine()->getRepository('Swe\Compenent\Invoice\Model\Invoice');
        $invoice=$em->find($id);
        $now = new \DateTime();
        $organism=$invoice->getPatient()->getOrganism()->getName();
        $template = sprintf('SweInvoiceBundle:Invoice:%s.pdf.twig',$organism);
        $res=$this->renderView($template,array('invoice'=>$invoice));
        $filename = sprintf('tefhst'.$now->getTimestamp().'.pdf', date('Y-m-d'));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($res),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('inline; filename="%s"', $filename),
            ]
        );
    }
}