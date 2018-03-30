<?php

namespace AppBundle\Stat\Text;

use AppBundle\Service\TextService;
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
     * @var \AppBundle\Service\TextService
     */
    protected $textService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->textService->getRepository()->getCount([]));

        return $datum;
    }
}
