<?php

namespace AppBundle\Stat\Page;

use AppBundle\Service\PageService;
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
     * @var \AppBundle\Service\PageService
     */
    protected $pageService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->pageService->getRepository()->getCount([]));

        return $datum;
    }
}
