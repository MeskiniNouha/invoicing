<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 25/03/2017
 * Time: 23:44
 */

namespace Swe\Bundle\InvoiceBundle\Controller;


use Swe\Compenent\Invoice\Model\Invoice;
use Swe\Compenent\Invoice\Model\InvoiceItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;
use Doctrine\Common\Collections\ArrayCollection;

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
        $invoice = new Invoice();
        $form = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
        $form->handleRequest($request);
       // if ($form->isSubmitted() && $form->isValid()) {
        if ($invoice->getDesignation()!=null) {
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
        $item= new InvoiceItem();
        $items =
        $form = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceItemType', $item);
        $deleteForm = $this->createDeleteForm($invoice);
        return $this->render('SweInvoiceBundle:Invoice:show.html.twig', array(
            'invoice' => $invoice,
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Invoice $invoice)
    {
        $deleteForm = $this->createDeleteForm($invoice);
        $originalItems = new ArrayCollection();
        foreach ($invoice->getInvoiceItems() as $item) {
            $originalItems->add($item);
    }
        $em =  $this->getDoctrine()->getManager();

        $editForm = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
        //if ($invoice->getId()!=null) {
           foreach ($originalItems as $itemm) {
                if (false === $invoice->getInvoiceItems()->contains($itemm)) {
                    $itemm->setInvoice(null);
                    $em->remove($itemm);
                }
            }
            $em->persist($invoice);
            $em->flush();


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
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $items=$invoice->getInvoiceItems();
            foreach ($items as $item) {
                    $item->setInvoice(null);
                    $em->remove($item);
            }
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


    public function changeStateAction ($id,$transition) {
        $em = $this->getDoctrine()->getManager();
        $invoice=$em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->find($id);
        $workflow = $this->container->get('state_machine.invoice');
        $workflow->apply($invoice,$transition);
        $em->persist($invoice);
        $em->flush();
        return $this->redirectToRoute('Swe_invoice_show', array('id' => $invoice->getId()));
    }

    public function deleteItemAction(Request $request, InvoiceItem $invoiceItem)
    {
        $form = $this->createDeleteItemForm($invoiceItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoiceItem);
            $em->flush();
        }

        return $this->redirectToRoute('Swe_invoice_edit', array('id' => $invoiceItem->getInvoice()->getId()));
    }

    private function createDeleteItemForm(InvoiceItem $invoiceItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Swe_invoiceItem_delete', array('id' => $invoiceItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}