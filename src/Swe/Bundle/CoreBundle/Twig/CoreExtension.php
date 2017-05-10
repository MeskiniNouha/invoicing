<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 13/04/2017
 * Time: 17:20
 */

namespace Swe\Bundle\CoreBundle\Twig;


use Symfony\Component\DependencyInjection\Container;

class CoreExtension extends \Twig_Extension
{
    protected $container;

    public function __construct (Container $container) {
        $this->container=$container;
    }

    public function enableTransition ($invoice) {
    $workflow = $this->container->get('state_machine.invoice');
    $transitions = $workflow->getEnabledTransitions($invoice);
    return $transitions;
}

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('btnWorkflow', array($this, 'enableTransition')),
        );
    }

}