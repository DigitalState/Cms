<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\File;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class FileFixture
 */
abstract class FileFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $files = $this->parse($this->getResource());

        foreach ($files as $file) {
            $entity = new File;
            $entity
                ->setUuid($file['uuid'])
                ->setOwner($file['owner'])
                ->setOwnerUuid($file['owner_uuid'])
                ->setSlug($file['slug'])
                ->setTitle($file['title'])
                ->setDescription($file['description'])
                ->setPresentation($file['presentation'])
                ->setType($file['type']);
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
