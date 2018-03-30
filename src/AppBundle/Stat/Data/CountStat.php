<?php

namespace AppBundle\Stat\Data;

use AppBundle\Service\DataService;
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
     * @var \AppBundle\Service\DataService
     */
    protected $dataService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\DataService $dataService
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->dataService->getRepository()->getCount([]));

        return $datum;
    }
}
