<?php

namespace App\Service;

use App\Entity\Data;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class DataService
 */
final class DataService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, $entity = Data::class)
    {
        parent::__construct($manager, $entity);
    }
}
