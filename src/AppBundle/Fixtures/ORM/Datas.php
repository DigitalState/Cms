<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\DataFixture;
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
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/datas.yml';
    }
}
