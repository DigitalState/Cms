<?php

namespace App\Fixture;

use App\Entity\Text as TextEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Text
 */
trait Text
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $text = new TextEntity;
            $text
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setValue((array) $object->value)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $text->setCreatedAt($date);
            }

            $manager->persist($text);
            $manager->flush();
        }
    }
}
