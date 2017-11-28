<?php

namespace AppBundle\Action\File;

use AppBundle\Entity\File;
use Ds\Component\Security\Model\Permission;
use Ds\Component\Security\Model\Subject;
use Ds\Component\Security\Voter\Permission\PropertyVoter;
use LogicException;
use Symfony\Component\HttpFoundation\Response;
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
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     * @param \Ds\Component\Security\Voter\Permission\PropertyVoter $propertyVoter
     */
    public function __construct(TokenStorageInterface $tokenStorage, PropertyVoter $propertyVoter)
    {
        $this->tokenStorage = $tokenStorage;
        $this->propertyVoter = $propertyVoter;
    }

    /**
     * Presentation
     *
     * @Method("GET")
     * @Route(
     *     name="file_presentation",
     *     path="/files/{id}/presentation/{locale}",
     *     defaults={
     *         "_api_resource_class"=File::class,
     *         "_api_item_operation_name"="get_presentation"
     *     }
     * )
     */
    public function get($data)
    {
        $token = $this->tokenStorage->getToken();
        $subject = new Subject;
        $subject
            ->setType(Permission::PROPERTY)
            ->setValue(File::class.'.presentation')
            ->setEntity($data->getOwner())
            ->setEntityUuid($data->getOwnerUuid());

        $vote = $this->propertyVoter->vote($token, $subject, [Permission::READ]);

        if (PropertyVoter::ACCESS_ABSTAIN === $vote) {
            throw new LogicException('Voter cannot abstain from voting.');
        }

        if (PropertyVoter::ACCESS_GRANTED !== $vote) {
            throw new AccessDeniedException('Access denied.');
        }

        $presentation = base64_decode($data->getPresentation()['en']);
        $type = $data->getType();
        $response = new Response($presentation, Response::HTTP_OK, ['Content-Type' => $type]);

        return $response;
    }
}
