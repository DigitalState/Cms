<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Data;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class DataFixture
 */
abstract class DataFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = $this->parse($this->getResource());

        foreach ($datas as $data) {
            $entity = new Data;
            $entity
                ->setUuid($data['uuid'])
                ->setOwner($data['owner'])
                ->setOwnerUuid($data['owner_uuid'])
                ->setSlug($data['slug'])
                ->setTitle($data['title'])
                ->setData($data['data']);
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
