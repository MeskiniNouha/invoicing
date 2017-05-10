<?php

namespace Swe\Bundle\InvoiceBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;





class InvoiceType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateInvoicing', DateType::class, array(
            'placeholder' => 'Select a value',
            'widget' => 'single_text',
            'required'    => false,
            'empty_data'  => null
        ))
            ->add('designation',null, array(
            'required'    => false,
            'empty_data'  => null
        ))
            ->add('amount',null, array(
                'required'    => false,
                'empty_data'  => null
        ))
            ->add('patient', EntityType::class, array(
                'class' => 'Swe\Compenent\Core\Model\Patient',
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'cin'
                ));
      /*  ->add('invoiceItems', CollectionType::class, array(
        'entry_type' => InvoiceItemType::class,
        'allow_add' => true, // permet d'ajouter as many tag forms as i need
        'allow_delete' => true,
        'by_reference' => false
    ));*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swe\Compenent\Invoice\Model\Invoice'
        ));
      //  $resolver->setRequired(array('patients'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'invoicebundle_invoice';
    }


}
