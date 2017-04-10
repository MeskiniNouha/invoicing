<?php
/**
 * Created by PhpStorm.
 * User: POSTE
 * Date: 10/04/2017
 * Time: 15:55
 */

namespace Swe\Bundle\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Swe\Compenent\Core\Model\Organism;
use Doctrine\Common\Persistence\ObjectManager;

class LoadOrganismData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $organism=new Organism();
        $this->giveName('CNSS','','','',$organism,$manager);
        $this->giveName('AXA','','','',$organism,$manager);
        $this->giveName('CNOPS','','','',$organism,$manager);
    }

    public function giveName ($name,$rib,$bank,$agency,$organism,$manager) {
        $organism=new Organism();
        $organism->setName($name);
        $organism->setRib($rib);
        $organism->setBank($bank);
        $organism->setAgency($agency);
        $manager->persist($organism);
        $manager->flush();
    }

}