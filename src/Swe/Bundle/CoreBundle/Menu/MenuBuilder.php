<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 21/04/2017
 * Time: 02:46
 */

namespace Swe\Bundle\CoreBundle\Menu;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use KnpMenuFactoryInterface;
use SymfonyComponentHttpFoundationRequest;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('HD PATIENTS', array('route' => 'Swe_HDpatient_homepage'));
        $menu->addChild('CONSULTING PATIENTS', array('route' => 'Swe_Consultingpatient_homepage'));
        $menu->addChild('INVOICES', array('route' => 'Swe_invoice_homepage'));
        $menu->addChild('ORGANISMS', array('route' => 'Swe_organism_homepage'));

        return $menu;
    }
}