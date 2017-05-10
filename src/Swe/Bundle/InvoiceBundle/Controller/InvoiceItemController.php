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
use Swe\Compenent\Invoice\Model\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swe\Compenent\Invoice\Model\InvoiceItem;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function postItemAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $invoice = $em->getRepository('Swe\Compenent\Invoice\Model\Invoice')->find($id);
        $invoiceItem = new InvoiceItem();
        $object = $request->get('object');
        $quantity = $request->get('quantity');
        $amount = $request->get('amount');
        $invoiceItem->setObject($object);
        $invoiceItem->setQuantity($quantity);
        $invoiceItem->setAmount($amount);
        $invoiceItem->setInvoice($invoice);
        $em->persist($invoiceItem);
        $invoice->addInvoiceItem($invoiceItem);
        $em->flush();
        return true;
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