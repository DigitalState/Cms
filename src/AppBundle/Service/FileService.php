<?php

namespace AppBundle\Service;

use AppBundle\Entity\File;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class FileService
 */
class FileService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = File::class)
    {
        parent::__construct($manager, $entity);
    }
}
