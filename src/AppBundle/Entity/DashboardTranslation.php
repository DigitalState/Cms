<?php

namespace AppBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TextTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_dashbord_trans")
 */
class DashboardTranslation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
