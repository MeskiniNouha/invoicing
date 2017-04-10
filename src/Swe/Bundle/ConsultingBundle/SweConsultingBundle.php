<?php

namespace Swe\Bundle\ConsultingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Swe\Bundle\ResourceBundle\Compiler\ResolveDoctrineTargetEntitiesPass;

class SweConsultingBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container) {

        parent::build($container);

        $interfaces = array(
            'Swe\Compenent\Core\Model\PatientInterface'    => 'swe.model.patient.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('Swe_consulting', $interfaces));

        $modelDir = realpath(__DIR__ . '/Resources/config/doctrine/model');
        $mappings = array(
            $modelDir => 'Swe\Compenent\Consulting\Model',
        );


        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                $mappings));



    }
}
