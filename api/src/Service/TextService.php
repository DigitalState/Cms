<?php

namespace App\Service;

use App\Entity\Text;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class TextService
 */
final class TextService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Text::class)
    {
        parent::__construct($manager, $entity);
    }
}
