<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\DataFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Datas
 */
class Datas extends DataFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/datas.yml';
    }
}
