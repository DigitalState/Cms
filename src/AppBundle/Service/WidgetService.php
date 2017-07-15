<?php

namespace AppBundle\Service;

use AppBundle\Entity\Widget;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class WidgetService
 */
class WidgetService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Widget::class)
    {
        parent::__construct($manager, $entity);
    }
}
