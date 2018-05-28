<?php

namespace AppBundle\Tenant\Initializer;

use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Tenant\Initializer\Initializer;

/**
 * Class ConfigInitializer
 */
class ConfigInitializer implements Initializer
{
    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $data)
    {
        $items = [];
        $manager = $this->configService->getManager();

        foreach ($items as $item) {
            $config = $this->configService->createInstance();
            $config
                ->setOwner('BusinessUnit')
                ->setOwnerUuid($data['business_unit']['administration']['uuid'])
                ->setKey($item['key'])
                ->setValue($item['value'])
                ->setTenant($data['tenant']['uuid']);
            $manager->persist($config);
            $manager->flush();
        }
    }
}
