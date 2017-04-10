<?php

namespace Swe\Bundle\ConsultingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ConsultingPatientType extends AbstractType
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
                 ->add('consultationMotif')
                 ->add('histoireClinique')
                 ->add('diagnostic');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swe\Compenent\Consulting\Model\ConsultingPatient'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Consultingpatientbundle_patient';
    }


}
