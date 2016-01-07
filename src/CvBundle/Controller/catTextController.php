<?php

namespace CvBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Entity\catText;
use CvBundle\Form\catTextType;

/**
 * catText controller.
 *
 * @Route("/admin/categorie2textes/")
 */
class catTextController extends Controller {

    /**
     * Lists all catText entities.
     *
     * @Route("/", name="admin_categorie2textes_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $catTexts = $em->getRepository('CvBundle:catText')->findAll();

        return $this->render('cattext/index.html.twig', array(
                    'catTexts' => $catTexts,
        ));
    }

    /**
     * Creates a new catText entity.
     *
     * @Route("/new", name="admin_categorie2textes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $catText = new catText();
        $form = $this->createForm('CvBundle\Form\catTextType', $catText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catText);
            $em->flush();

            return $this->redirectToRoute('admin_categorie2textes_show', array('id' => $catText->getId()));
        }

        return $this->render('cattext/new.html.twig', array(
                    'catText' => $catText,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a catText entity.
     *
     * @Route("/{id}", name="admin_categorie2textes_show")
     * @Method("GET")
     */
    public function showAction(catText $catText) {
        $deleteForm = $this->createDeleteForm($catText);

        return $this->render('cattext/show.html.twig', array(
                    'catText' => $catText,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing catText entity.
     *
     * @Route("/{id}/edit", name="admin_categorie2textes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, catText $catText) {
        $deleteForm = $this->createDeleteForm($catText);
        $editForm = $this->createForm('CvBundle\Form\catTextType', $catText);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catText);
            $em->flush();

            return $this->redirectToRoute('admin_categorie2textes_edit', array('id' => $catText->getId()));
        }

        return $this->render('cattext/edit.html.twig', array(
                    'catText' => $catText,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a catText entity.
     *
     * @Route("/{id}", name="admin_categorie2textes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, catText $catText) {
        $form = $this->createDeleteForm($catText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catText);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categorie2textes_index');
    }

    /**
     * Creates a form to delete a catText entity.
     *
     * @param catText $catText The catText entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(catText $catText) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_categorie2textes_delete', array('id' => $catText->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
