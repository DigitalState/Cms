<?php

namespace AppBundle\Service;

use AppBundle\Entity\Dashboard;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class DashboardService
 */
class DashboardService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Dashboard::class)
    {
        parent::__construct($manager, $entity);
    }
}
