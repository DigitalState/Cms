<?php

namespace App\Fixture;

use App\Entity\Data as DataEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Data
 */
trait Data
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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_data_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_data_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $data = new DataEntity;
            $data
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setData(json_decode(json_encode($object->data), true))
                ->setTenant($object->tenant);
            $manager->persist($data);
            $manager->flush();
        }
    }
}
