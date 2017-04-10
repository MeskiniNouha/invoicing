<?php

namespace Swe\Bundle\InvoiceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Swe\Bundle\ResourceBundle\Compiler\ResolveDoctrineTargetEntitiesPass;

class SweInvoiceBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container) {

        parent::build($container);

        $interfaces = array(
            'Swe\Compenent\Invoice\Model\InvoiceInterface'    => 'swe.model.invoice.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('swe_invoice', $interfaces));

        $modelDir = realpath(__DIR__ . '/Resources/config/doctrine/model');
        $mappings = array(
            $modelDir => 'Swe\Compenent\Invoice\Model',
        );


        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                $mappings));



    }
}
