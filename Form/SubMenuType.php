<?php

namespace Tucompu\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubMenuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                'attr' => array(
                    'class'=>'form-control'
                )
            ))
            ->add('isActive',null,array(
                'attr' => array(
                    'class'=>'form-control'
                )
            ))
            ->add('menu',null,array(
                'attr' => array(
                    'class'=>'form-control'
                )
            ))
            ->add('article',null,array(
                'attr' => array(
                    'class'=>'form-control'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tucompu\CmsBundle\Entity\SubMenu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tucompu_cmsbundle_submenu';
    }


}
