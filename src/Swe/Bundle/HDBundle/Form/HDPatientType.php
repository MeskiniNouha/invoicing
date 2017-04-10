<?php

namespace Swe\Bundle\HDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HDPatientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
                ->add('lastName')
                ->add('cin')
                ->add('organism',EntityType::class, array(
                    'class'=>'Swe\Compenent\Core\Model\Organism',
                    'expanded'=>false,
                    'multiple'=>false,
                    'choice_label'=>'name'
                ))
                ->add('technique')
                ->add('module')
                ->add('line');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swe\Compenent\HD\Model\HDPatient'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'HDpatientbundle_patient';
    }


}
