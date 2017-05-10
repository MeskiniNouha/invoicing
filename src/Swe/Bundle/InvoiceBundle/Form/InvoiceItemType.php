<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 13/04/2017
 * Time: 12:34
 */

namespace Swe\Bundle\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InvoiceItemType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object')
            ->add('quantity')
            ->add('amount')
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swe\Compenent\Invoice\Model\InvoiceItem'
        ));

        //  $resolver->setRequired(array('patients'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'invoicebundle_invoiceItem';
    }

}