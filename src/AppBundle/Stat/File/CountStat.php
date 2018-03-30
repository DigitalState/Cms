<?php

namespace AppBundle\Stat\File;

use AppBundle\Service\FileService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\FileService
     */
    protected $fileService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->fileService->getRepository()->getCount([]));

        return $datum;
    }
}
