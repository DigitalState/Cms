<?php

namespace AppBundle\Service;

use AppBundle\Entity\Text;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class TextService
 */
class TextService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Text::class)
    {
        parent::__construct($manager, $entity);
    }
}
