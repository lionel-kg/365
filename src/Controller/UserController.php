<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use App\Manager\AdresseManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

     /**
     * @Route("/user/create", name="create_user", methods={"POST"})
     */
    public function createUser(Request $request, UserManager $userManager,AdresseManager $adresseManager):JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['username']) || empty($data['password'])) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
            $userManager->createUser($data);
        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }
    
}