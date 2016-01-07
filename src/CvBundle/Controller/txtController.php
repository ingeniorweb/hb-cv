<?php

namespace CvBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Entity\txt;
use CvBundle\Form\txtType;

/**
 * txt controller.
 *
 * @Route("/admin/texts")
 */
class txtController extends Controller {

    /**
     * Lists all txt entities.
     *
     * @Route("/", name="admin_texts_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $txts = $em->getRepository('CvBundle:txt')->findAll();

        return $this->render('txt/index.html.twig', array(
                    'txts' => $txts,
        ));
    }

    /**
     * Creates a new txt entity.
     *
     * @Route("/new", name="admin_texts_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $txt = new txt();
        $form = $this->createForm('CvBundle\Form\txtType', $txt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($txt);
            $em->flush();

            return $this->redirectToRoute('admin_textes_show', array('id' => $txt->getId()));
        }

        return $this->render('txt/new.html.twig', array(
                    'txt' => $txt,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a txt entity.
     *
     * @Route("/{id}", name="admin_texts_show")
     * @Method("GET")
     */
    public function showAction(txt $txt) {
        $deleteForm = $this->createDeleteForm($txt);

        return $this->render('txt/show.html.twig', array(
                    'txt' => $txt,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing txt entity.
     *
     * @Route("/{id}/edit", name="admin_texts_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, txt $txt) {
        $deleteForm = $this->createDeleteForm($txt);
        $editForm = $this->createForm('CvBundle\Form\txtType', $txt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($txt);
            $em->flush();

            return $this->redirectToRoute('admin_textes_edit', array('id' => $txt->getId()));
        }

        return $this->render('txt/edit.html.twig', array(
                    'txt' => $txt,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a txt entity.
     *
     * @Route("/{id}", name="admin_texts_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, txt $txt) {
        $form = $this->createDeleteForm($txt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($txt);
            $em->flush();
        }

        return $this->redirectToRoute('admin_textes_index');
    }

    /**
     * Creates a form to delete a txt entity.
     *
     * @param txt $txt The txt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(txt $txt) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_textes_delete', array('id' => $txt->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
