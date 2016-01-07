<?php

namespace CvBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Entity\texte;
use CvBundle\Form\texteType;

/**
 * texte controller.
 *
 * @Route("/admin/textes")
 */
class texteController extends Controller
{
    /**
     * Lists all texte entities.
     *
     * @Route("/", name="admin_textes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $textes = $em->getRepository('CvBundle:texte')->findAll();

        return $this->render('texte/index.html.twig', array(
            'textes' => $textes,
        ));
    }

    /**
     * Creates a new texte entity.
     *
     * @Route("/new", name="admin_textes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $texte = new texte();
        $form = $this->createForm('CvBundle\Form\texteType', $texte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texte);
            $em->flush();

            return $this->redirectToRoute('admin_textes_show', array('id' => $texte->getId()));
        }

        return $this->render('texte/new.html.twig', array(
            'texte' => $texte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a texte entity.
     *
     * @Route("/{id}", name="admin_textes_show")
     * @Method("GET")
     */
    public function showAction(texte $texte)
    {
        $deleteForm = $this->createDeleteForm($texte);

        return $this->render('texte/show.html.twig', array(
            'texte' => $texte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing texte entity.
     *
     * @Route("/{id}/edit", name="admin_textes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, texte $texte)
    {
        $deleteForm = $this->createDeleteForm($texte);
        $editForm = $this->createForm('CvBundle\Form\texteType', $texte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texte);
            $em->flush();

            return $this->redirectToRoute('admin_textes_edit', array('id' => $texte->getId()));
        }

        return $this->render('texte/edit.html.twig', array(
            'texte' => $texte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a texte entity.
     *
     * @Route("/{id}", name="admin_textes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, texte $texte)
    {
        $form = $this->createDeleteForm($texte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texte);
            $em->flush();
        }

        return $this->redirectToRoute('admin_textes_index');
    }

    /**
     * Creates a form to delete a texte entity.
     *
     * @param texte $texte The texte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(texte $texte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_textes_delete', array('id' => $texte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
