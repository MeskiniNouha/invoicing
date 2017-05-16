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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('object', TextType::class, array('label'=> 'Object','attr'=> array('class'=>"form-control")))
            ->add('quantity',NumberType::class, array('label'=> 'Quantity','attr'=> array('class'=>"form-control")))
            ->add('amount',NumberType::class, array('label'=> 'Amount','attr'=> array('class'=>"form-control")))
            ->add('save',SubmitType::class,array('label'=> 'Save item','attr'=> array('style'=>' float : right ; margin-bottom:5px;')));
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