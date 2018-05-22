<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Text;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class TextFixture
 */
abstract class TextFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $text = new Text;
            $text
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setValue((array) $object->value)
                ->setTenant($object->tenant);
            $manager->persist($text);
            $manager->flush();
        }
    }
}
