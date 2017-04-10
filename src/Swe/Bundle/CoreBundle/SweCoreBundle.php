<?php

namespace Swe\Bundle\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Swe\Bundle\ResourceBundle\Compiler\ResolveDoctrineTargetEntitiesPass;

class SweCoreBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container) {

        parent::build($container);

        $interfaces = array(
            'Swe\Compenent\Core\Model\PatientInterface'    => 'swe.model.patient.class',
            'Swe\Compenent\Core\Model\OrganismInterface'    => 'swe.model.organism.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('Swe_core', $interfaces));

        $modelDir = realpath(__DIR__ . '/Resources/config/doctrine/model');
        $mappings = array(
            $modelDir => 'Swe\Compenent\Core\Model',
        );


        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                $mappings));



    }
}
