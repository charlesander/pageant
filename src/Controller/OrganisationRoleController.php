<?php

namespace App\Controller;

use App\Repository\OrganisationRoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


class OrganisationRoleController extends AbstractController
{
    /**
     * @var OrganisationRoleRepository
     */
    private $organisationRoleRepository;

    public function __construct(
        OrganisationRoleRepository $organisationRoleRepository
    ) {
        $this->organisationRoleRepository     = $organisationRoleRepository;
    }

    /**
     * @Route("/organisation-role", name="organisation_role_index", methods={"GET"})
     */
    public function index()
    {
        return $this->organisationRoleRepository->findAll();
    }

    /**
     * @Route("/organisation-role/{id}", name="organisation_role_index", methods={"GET"})
     */
    public function get($id)
    {
        return $this->organisationRoleRepository->find($id);
    }
}
