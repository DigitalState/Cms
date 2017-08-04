<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\FileFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Files
 */
class Files extends FileFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/files.yml';
    }
}
