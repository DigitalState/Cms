<?php

namespace AppBundle\Service;

use AppBundle\Entity\Data;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class DataService
 */
class DataService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Data::class)
    {
        parent::__construct($manager, $entity);
    }
}
