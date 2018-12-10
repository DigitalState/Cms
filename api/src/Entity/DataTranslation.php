<?php

namespace App\Entity;

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

    use Accessor\Title;
    use Accessor\Data;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
