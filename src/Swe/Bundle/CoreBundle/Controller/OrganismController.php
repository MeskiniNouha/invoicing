<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 10/04/2017
 * Time: 01:38
 */

namespace Swe\Bundle\CoreBundle\Controller;


use Swe\Compenent\Core\Model\Organism;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganismController extends Controller
{
    /**
     * Lists all Organism entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        /*var_dump(1);
        die(1);
        $organizations =null;*/
        $organisms=$em->getRepository('Swe\Compenent\Core\Model\Organism')->findAll();

        return $this->render('SweCoreBundle:Organism:index.html.twig', array(
            'organizations' => $organisms,
        ));
    }


    /**
     * Finds and displays a Organism entity.
     *
     */
    public function showAction(Organism $organism)
    {
        $deleteForm = $this->createDeleteForm($organism);

        return $this->render('SweCoreBundle:Organism:show.html.twig', array(
            'organization' => $organism,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organism entity.
     *
     */
    public function editAction(Request $request, Organism $organism)
    {
        $deleteForm = $this->createDeleteForm($organism);
        $editForm = $this->createForm('Swe\Bundle\CoreBundle\Form\OrganismType', $organism);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Swe_organism_edit', array('id' => $organism->getId()));
        }

        return $this->render('SweCoreBundle:Organism:edit.html.twig', array(
            'Organization' => $organism,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Organism entity.
     *
     */
    public function deleteAction(Request $request, Organism $organism)
    {
        $form = $this->createDeleteForm($organism);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organism);
            $em->flush();
        }

        return $this->redirectToRoute('Swe_organism_homepage');
    }

    /**
     * Creates a form to delete a Organization entity.
     *
     * @param Organism $organism The Organism entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Organism $organism)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Swe_organism_delete', array('id' => $organism->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}