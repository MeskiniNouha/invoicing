<?php

namespace Swe\Bundle\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateInvoicing',DateType::class, array(
        'placeholder' => 'Select a value',
            'widget' => 'single_text',
        ))
                ->add('designation')
                ->add('amount')
                ->add('patient',EntityType::class, array(
                    'class'=>'Swe\Compenent\Core\Model\Patient',
                    'expanded'=>false,
                    'multiple'=>false,
                    'choice_label'=>'cin'

                ))
            ->add('invoiceItems', 'collection', array(
                'type'         => 'swe_invoiceItem',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'swe.form.invoice.invoiceItems'
            ));
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
