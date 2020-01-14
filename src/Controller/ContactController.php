<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Rest\RouteResource(
 *     "Contact",
 *     pluralize=false
 * )
 */
class ContactController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }
    
    /**
     * @Route("/contact", name="contact_index", methods={"GET"})
     */
    public function index()
    {
        return $this->contactRepository->findAll();
    }

    /**
     * @Route("/contact", name="contact_post", methods={"POST"})
     */
    public function post()
    {
        return new JsonResponse('post');
    }

    /**
     * @Route("/contact/{id}", name="contact_put", methods={"PUT"})
     */
    public function put($id)
    {
        return new JsonResponse('patch ' . $id);
    }

    /**
     * @Route("/contact/{id}", name="contact_patch", methods={"PATCH"})
     */
    public function patch($id)
    {
        return new JsonResponse('patch ' . $id);
    }

    /**
     * @Route("/contact/{id}", name="contact_get", methods={"GET"})
     */
    public function get($id)
    {
        return $this->contactRepository->find($id);
    }

    /**
     * @Route("/contact/{id}", name="contact_delete", methods={"DELETE"})
     */
    public function delete($id)
    {
        return new JsonResponse('patch ' . $id);
    }
}
