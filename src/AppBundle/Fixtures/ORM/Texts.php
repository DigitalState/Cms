<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\TextFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Texts
 */
class Texts extends TextFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/texts.yml';
    }
}
