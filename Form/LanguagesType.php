<?php

namespace Tucompu\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LanguagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', ChoiceType::class, array(
                'choices'  => array(
                    'es' => 'es',
                    'en' => 'en',
                    'fr' => 'fr'
                )
            ))
            ->add('language')
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
            'data_class' => 'Tucompu\CmsBundle\Entity\Languages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cmsbundle_languages';
    }
}
