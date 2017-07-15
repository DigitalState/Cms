<?php

namespace AppBundle\Service;

use AppBundle\Entity\Page;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class PageService
 */
class PageService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Page::class)
    {
        parent::__construct($manager, $entity);
    }
}
