<?php

namespace AppBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DataTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_data_trans")
 */
class DataTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
