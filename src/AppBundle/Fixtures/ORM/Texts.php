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
        return __DIR__.'/../../Resources/data/{env}/texts.yml';
    }
}
