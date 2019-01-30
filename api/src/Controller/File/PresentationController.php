<?php

namespace App\Controller\File;

use App\Entity\File;
use App\Service\FileService;
use Ds\Component\Acl\Model\Permission;
use Ds\Component\Acl\Voter\PropertyVoter;
use LogicException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use ApiPlatform\Core\Annotation\ApiResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PresentationController
 *
 * @ApiResource
 */
final class PresentationController
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    /**
     * @var \App\Service\FileService
     */
    private $fileService;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var \Ds\Component\Acl\Voter\PropertyVoter
     */
    private $propertyVoter;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \App\Service\FileService $fileService
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     * @param \Ds\Component\Acl\Voter\PropertyVoter $propertyVoter
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
     * @Route(path="/files/{slug}/presentation", methods={"GET"})
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
