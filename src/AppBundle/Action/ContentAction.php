<?php

namespace AppBundle\Action;

use AppBundle\Service\DataService;
use AppBundle\Service\TextService;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContentAction
 */
class ContentAction
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $requestStack;

    /**
     * @var \AppBundle\Service\TextService
     */
    protected $textService;

    /**
     * @var \AppBundle\Service\DataService
     */
    protected $dataService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \AppBundle\Service\TextService $textService
     * @param \AppBundle\Service\DataService $dataService
     */
    public function __construct(RequestStack $requestStack, TextService $textService, DataService $dataService)
    {
        $this->requestStack = $requestStack;
        $this->textService = $textService;
        $this->dataService = $dataService;
    }

    /**
     * Content
     *
     * @Method("GET")
     * @Route(path="/content")
     */
    public function get()
    {
        $request = $this->requestStack->getCurrentRequest();
        $types = ['text', 'data'];
        $content = new StdClass;

        foreach ($types as $type) {
            $slugs = $request->query->get($type.'s', []);

            if ($slugs) {
                $content->{$type.'s'} = new stdClass;
                $entities = $this->{$type.'Service'}->getRepository()->findBy(['slug' => $slugs]);

                if (count($entities) !== count($slugs)) {
                    throw new NotFoundHttpException('Entities not found.');
                }

                foreach ($entities as $entity) {
                    $content->{$type . 's'}->{$entity->getSlug()} = new stdClass;

                    switch ($type) {
                        case 'text':
                            $content->{$type . 's'}->{$entity->getSlug()}->value = $entity->getValue();
                            break;

                        case 'data':
                            $content->{$type . 's'}->{$entity->getSlug()}->data = $entity->getData();
                            break;
                    }
                }
            }
        }

        return new JsonResponse($content);
    }
}
