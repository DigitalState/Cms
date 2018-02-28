<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\FileFixture;
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/files.yml';
    }
}
