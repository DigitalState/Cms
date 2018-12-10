<?php

namespace App\Controller;

use App\Service\DataService;
use App\Service\FileService;
use App\Service\TextService;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

use ApiPlatform\Core\Annotation\ApiResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContentController
 *
 * @ApiResource
 */
final class ContentController
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    /**
     * @var \App\Service\DataService
     */
    private $dataService;

    /**
     * @var \App\Service\FileService
     */
    private $fileService;

    /**
     * @var \App\Service\TextService
     */
    private $textService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \App\Service\DataService $dataService
     * @param \App\Service\FileService $fileService
     * @param \App\Service\TextService $textService
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
     * @Route(path="/content", methods={"GET"})
     * @Security("is_granted('BROWSE', 'content')")
     */
    public function get()
    {
        $request = $this->requestStack->getCurrentRequest();
        $types = ['data', 'file', 'text'];
        $content = new StdClass;

        foreach ($types as $type) {
            $slugs = $request->query->get($type.'s', []);

            if ($slugs) {
                $collection = $type.'s';
                $service = $type.'Service';
                $content->$collection = new stdClass;
                $entities = $this->$service->getRepository()->findBy(['slug' => $slugs]);

                foreach ($slugs as $slug) {
                    $content->$collection->$slug = null;

                    foreach ($entities as $entity) {
                        if ($entity->getSlug() !== $slug) {
                            continue;
                        }

                        $content->$collection->$slug = new stdClass;

                        switch ($type) {
                            case 'data':
                                $content->$collection->$slug = $entity->getData();
                                break;

                            case 'file':
                                $content->$collection->$slug->type = $entity->getType();
                                $content->$collection->$slug->presentation = $entity->getPresentation();
                                break;

                            case 'text':
                                $content->$collection->$slug = $entity->getValue();
                                break;
                        }
                    }
                }
            }
        }

        return new JsonResponse($content);
    }
}
