<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Text;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

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
        $texts = $this->parse($this->getResource());

        foreach ($texts as $text) {
            $entity = new Text;
            $entity
                ->setUuid($text['uuid'])
                ->setOwner($text['owner'])
                ->setOwnerUuid($text['owner_uuid'])
                ->setSlug($text['slug'])
                ->setTitle($text['title'])
                ->setValue($text['value']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
