<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 02/05/2017
 * Time: 11:17
 */

namespace Swe\Bundle\InvoiceBundle\Controller;


use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Swe\Bundle\InvoiceBundle\Form\InvoiceItemType;
use Swe\Compenent\Invoice\Model\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swe\Compenent\Invoice\Model\InvoiceItem;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceItemController extends FOSRestController
{

    public function getListeItemAction () {
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('Swe\Compenent\Invoice\Model\InvoiceItem')->findAll();
        var_dump('nouha');
        return $items;
    }

    public function getItemsByInvoiceAction($id)
    {
        $em = $this->getDoctrine()->getRepository('Swe\Compenent\Invoice\Model\Invoice');
        $invoice=$em->find($id);
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('Swe\Compenent\Invoice\Model\InvoiceItem')->findBy(["invoice" => $invoice]);
        return $items;
    }

    public function postItemAction(Request $request,Invoice $invoice)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $invoice = $em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->find($invoice);
        if (!$invoice) {
            throw $this->createNotFoundException('can\'t find the invoice entity.');
        }
        $invoiceItem = new InvoiceItem();
        $form = $this->createForm('Swe\Bundle\InvoiceBundle\Form\InvoiceItemType',$invoiceItem);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $invoiceItem->setInvoice($invoice);
            $em->persist($invoiceItem);
            $em->flush();

            return new JsonResponse([
                    'status'=>200 ,
                    'id'  => $invoiceItem->getId(),
                    'message'=> 'The invoice item was added successfully '
                ]
            );
        }
        return new JsonResponse([
                'status'=>500 ,
                'message'=> 'Something goes wrong ! please try again !'
            ]
        );
    }


    /**
     * @param InvoiceItem $item : au lieu de chercher le item manuellement depuis la base de données y'a un composant ParamConverter
     *          il peut deviner et recuperer le item a partir de son id sans avoir a le faire explicitement comme :
     *          $item = $em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->find($item);
     *          et si jamais le item n'existe pas dans la bd il va s'occuper de declencher un exception
     * @return JsonResponse
     */
    public function findItemAction(InvoiceItem $item){

        return new JsonResponse($item->toArray());
    }

    public function updateItemAction($id,Request $request)
    {
        $object = $request->get('object');
        $quantity = $request->get('quantity');
        $amount = $request->get('amount');
        $invoice = $request->get('invoice');
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('Swe\Compenent\Invoice\Model\InvoiceItem')->find($id);
        if (!empty($item)) {
            if (!empty($object)) {
                $item->setObject($object);
            }
            if (!empty($quantity)) {
                $item->setQuantity($quantity);
            }
            if (!empty($amount)) {
                $item->setAmount($amount);
            }
            if (!empty($invoice)) {
                $item->setInvoice($em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->find($invoice));
            }
            $em->persist($item);
            $em->flush();
        }

        return $item;
}

    public function deleteItemAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('Swe\Compenent\Invoice\Model\InvoiceItem')->find($id);
        if (empty($item)) {
            return false;
        }
        else {
            $em->remove($item);
            $em->flush();
        }
        return true;
    }
}