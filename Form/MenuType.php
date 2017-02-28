<?php

namespace Tucompu\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MenuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article',null,array(
                'attr'=>array(
                    'class' => 'form-control'
                )
            ))
            ->add('name',null,array(
                'attr'=>array(
                    'class' => 'form-control'
                )
            ))
            ->add('position',null,array(
                'attr'=>array(
                    'class' => 'form-control'
                )
            ))
            ->add('isActive',null,array(
                'required'=>false,
                'attr'=>array('class'=>'switch_widget'),
                'label'=>'Estado'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tucompu\CmsBundle\Entity\Menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cmsbundle_menu';
    }
}
