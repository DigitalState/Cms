<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PageTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_page_trans")
 */
class PageTranslation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;
    use Accessor\Description;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
}
