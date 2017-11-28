<?php

namespace AppBundle\Action\File;

use AppBundle\Entity\File;
use AppBundle\Service\FileService;
use Ds\Component\Security\Model\Permission;
use Ds\Component\Security\Model\Subject;
use Ds\Component\Security\Voter\Permission\PropertyVoter;
use LogicException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use ApiPlatform\Core\Annotation\ApiResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PresentationAction
 *
 * @ApiResource
 */
class PresentationAction
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $requestStack;

    /**
     * @var \AppBundle\Service\FileService
     */
    protected $fileService;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var \Ds\Component\Security\Voter\Permission\PropertyVoter
     */
    protected $propertyVoter;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     * @param \Ds\Component\Security\Voter\Permission\PropertyVoter $propertyVoter
     */
    public function __construct(RequestStack $requestStack, FileService $fileService, TokenStorageInterface $tokenStorage, PropertyVoter $propertyVoter)
    {
        $this->requestStack = $requestStack;
        $this->fileService = $fileService;
        $this->tokenStorage = $tokenStorage;
        $this->propertyVoter = $propertyVoter;
    }

    /**
     * Presentation
     *
     * @Method("GET")
     * @Route(path="/files/{slug}/presentation")
     */
    public function get($slug)
    {
        $request = $this->requestStack->getCurrentRequest();
        $file = $this->fileService->getRepository()->findOneBy(['slug' => $slug]);

        if (!$file) {
            throw new NotFoundHttpException('File not found.');
        }

        $token = $this->tokenStorage->getToken();
        $subject = new Subject;
        $subject
            ->setType(Permission::PROPERTY)
            ->setValue(File::class.'.presentation')
            ->setEntity($file->getOwner())
            ->setEntityUuid($file->getOwnerUuid());

        $vote = $this->propertyVoter->vote($token, $subject, [Permission::READ]);

        if (PropertyVoter::ACCESS_ABSTAIN === $vote) {
            throw new LogicException('Voter cannot abstain from voting.');
        }

        if (PropertyVoter::ACCESS_GRANTED !== $vote) {
            throw new AccessDeniedException('Access denied.');
        }

        $presentation = $file->getPresentation();
        $locale = $request->query->get('locale', null);

        if (!array_key_exists($locale, $presentation)) {
            throw new NotFoundHttpException('File locale not found.');
        }

        $presentation = base64_decode($presentation[$locale]);
        $type = $file->getType();
        $response = new Response($presentation, Response::HTTP_OK, ['Content-Type' => $type]);

        return $response;
    }
}
