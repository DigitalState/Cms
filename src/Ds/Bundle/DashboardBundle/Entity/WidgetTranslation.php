<?php

namespace Ds\Bundle\DashboardBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class WidgetTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_widget_trans")
 */
class WidgetTranslation
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
