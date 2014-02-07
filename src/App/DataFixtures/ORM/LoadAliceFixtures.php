<?php

namespace App\DataFixtures\ORM;

use Knp\RadBundle\DataFixtures\AbstractFixture;
use Symfony\Component\Finder\Finder;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadAliceFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $path = __DIR__.'/../../Resources/fixtures';

        foreach ($this->getAliceFiles($path) as $file) {
            Fixtures::load($file, $manager, $this->getAliceOptions());
        }
    }

    protected function getAliceFiles($path)
    {
        return Finder::create()
            ->files()
            ->name('*.yml')
            ->depth(0)
            ->sortByName()
            ->in($path)
        ;
    }

    protected function getAliceOptions()
    {
        return array('providers' => array($this));
    }
}
