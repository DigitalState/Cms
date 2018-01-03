<?php

namespace AppBundle\Action;

use AppBundle\Service\DataService;
use AppBundle\Service\FileService;
use AppBundle\Service\TextService;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use ApiPlatform\Core\Annotation\ApiResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContentAction
 *
 * @ApiResource
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
                            break;
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
