<?php

namespace CvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class texteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('date', 'date')
                ->add('titre')
                ->add('description')
                ->add('image')
                ->add('cat', EntityType::class, array('class' => 'CvBundle:categorie',
                    'choice_label' => 'nom', 'multiple' => true, 'expanded' => true))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CvBundle\Entity\texte'
        ));
    }

}
