<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Translation\Model\Type\Translation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FileTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_file_trans")
 */
class FileTranslation implements Translation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Presentation;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;
}
