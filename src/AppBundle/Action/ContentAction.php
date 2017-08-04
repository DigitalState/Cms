<?php

namespace AppBundle\Action;

use AppBundle\Service\DataService;
use AppBundle\Service\FileService;
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
     * @var \AppBundle\Service\DataService
     */
    protected $dataService;

    /**
     * @var \AppBundle\Service\FileService
     */
    protected $fileService;

    /**
     * @var \AppBundle\Service\TextService
     */
    protected $textService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \AppBundle\Service\DataService $dataService
     * @param \AppBundle\Service\FileService $fileService
     * @param \AppBundle\Service\TextService $textService
     */
    public function __construct(RequestStack $requestStack, DataService $dataService, FileService $fileService, TextService $textService)
    {
        $this->requestStack = $requestStack;
        $this->dataService = $dataService;
        $this->fileService = $fileService;
        $this->textService = $textService;
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
        $types = ['data', 'file', 'text'];
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
                    $content->{$type.'s'}->{$entity->getSlug()} = new stdClass;

                    switch ($type) {
                        case 'data':
                            $content->{$type.'s'}->{$entity->getSlug()} = $entity->getData();
                            break;

                        case 'file':
                            $content->{$type.'s'}->{$entity->getSlug()} = $entity->getPresentation();
                            break;

                        case 'text':
                            $content->{$type.'s'}->{$entity->getSlug()} = $entity->getValue();
                            break;
                    }
                }
            }
        }

        return new JsonResponse($content);
    }
}
