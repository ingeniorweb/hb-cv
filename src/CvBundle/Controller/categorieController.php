<?php

namespace CvBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Entity\categorie;
use CvBundle\Form\categorieType;

/**
 * categorie controller.
 *
 * @Route("/admin/categories")
 */
class categorieController extends Controller
{
    /**
     * Lists all categorie entities.
     *
     * @Route("/", name="admin_categories_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('CvBundle:categorie')->findAll();

        return $this->render('categorie/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new categorie entity.
     *
     * @Route("/new", name="admin_categories_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorie = new categorie();
        $form = $this->createForm('CvBundle\Form\categorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_show', array('id' => $categorie->getId()));
        }

        return $this->render('categorie/new.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/{id}", name="admin_categories_show")
     * @Method("GET")
     */
    public function showAction(categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);

        return $this->render('categorie/show.html.twig', array(
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     * @Route("/{id}/edit", name="admin_categories_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);
        $editForm = $this->createForm('CvBundle\Form\categorieType', $categorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_edit', array('id' => $categorie->getId()));
        }

        return $this->render('categorie/edit.html.twig', array(
            'categorie' => $categorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorie entity.
     *
     * @Route("/{id}", name="admin_categories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, categorie $categorie)
    {
        $form = $this->createDeleteForm($categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categories_index');
    }

    /**
     * Creates a form to delete a categorie entity.
     *
     * @param categorie $categorie The categorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(categorie $categorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categories_delete', array('id' => $categorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
