<?php

namespace CvBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Entity\skill;
use CvBundle\Form\skillType;

/**
 * skill controller.
 *
 * @Route("/admin/skills")
 */
class skillController extends Controller
{
    /**
     * Lists all skill entities.
     *
     * @Route("/", name="admin_skills_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('CvBundle:skill')->findAll();

        return $this->render('skill/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Creates a new skill entity.
     *
     * @Route("/new", name="admin_skills_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $skill = new skill();
        $form = $this->createForm('CvBundle\Form\skillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('admin_skills_show', array('id' => $skill->getId()));
        }

        return $this->render('skill/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a skill entity.
     *
     * @Route("/{id}", name="admin_skills_show")
     * @Method("GET")
     */
    public function showAction(skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);

        return $this->render('skill/show.html.twig', array(
            'skill' => $skill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     * @Route("/{id}/edit", name="admin_skills_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);
        $editForm = $this->createForm('CvBundle\Form\skillType', $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('admin_skills_edit', array('id' => $skill->getId()));
        }

        return $this->render('skill/edit.html.twig', array(
            'skill' => $skill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a skill entity.
     *
     * @Route("/{id}", name="admin_skills_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, skill $skill)
    {
        $form = $this->createDeleteForm($skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();
        }

        return $this->redirectToRoute('admin_skills_index');
    }

    /**
     * Creates a form to delete a skill entity.
     *
     * @param skill $skill The skill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(skill $skill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_skills_delete', array('id' => $skill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
