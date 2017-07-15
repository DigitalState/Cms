<?php

namespace AppBundle\Service;

use AppBundle\Entity\Template;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class TemplateService
 */
class TemplateService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Template::class)
    {
        parent::__construct($manager, $entity);
    }
}
