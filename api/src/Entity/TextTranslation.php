<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TextTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_text_trans")
 */
class TextTranslation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;
    use Accessor\Value;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;
}
