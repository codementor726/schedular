<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UserTbl;

#[Route('/api', name: 'api_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
 
    #[Route('/user/register', name: 'register_user', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
   
        $user = new UserTbl();
        $user->setName($request->request->get('name'));
        $user->setEmail($request->request->get('email'));
        $user->setFirstname($request->request->get('firstname'));
        $user->setLastname($request->request->get('lastname'));
        $user->setType($request->request->get('type')); //0:indicator, 1:auditor
        $user->setPassword($request->request->get('password'));
   
        $entityManager->persist($user);
        $entityManager->flush();
   
        $data =  [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'type' => $user->getType(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/user/login', name: 'login_user', methods:['post'] )]
    public function login(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $filter = array(
            "email" => $request->request->get('email'),
            "password" => $request->request->get('password'),
        );
        $users = $doctrine
            ->getRepository(UserTbl::class)
            ->findBy($filter);
        if($users)
            return $this->json('Login success');
        else
            return $this->json('Email or password is incorrect');
    }
 
    #[Route('/user/{id}', name: 'get_user', methods:['get'] )]
    public function get(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $user = $doctrine->getRepository(UserTbl::class)->find($id);
   
        if (!$user) {
            return $this->json('No user found for id ' . $id, 404);
        }
   
        $data =  [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'type' => $user->getType(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/user/{id}', name: 'update_user', methods:['put', 'patch'] )]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(UserTbl::class)->find($id);
   
        if (!$user) {
            return $this->json('No user found for id ' . $id, 404);
        }
   
        $user->setName($request->request->get('name'));
        $user->setEmail($request->request->get('email'));
        $user->setFirstname($request->request->get('firstname'));
        $user->setLastname($request->request->get('lastname'));
        $user->setType($request->request->get('type')); 
        $entityManager->flush();
   
        $data =  [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'type' => $user->getType(),
        ];
           
        return $this->json($data);
    }

    #[Route('/users/{type}', name: 'get_list', methods:['get'] )]
    public function getList1(ManagerRegistry $doctrine, int $type): JsonResponse
    {
        if($type>1)
            $users = $doctrine
                ->getRepository(UserTbl::class)
                ->findAll();
        else
            $users = $doctrine
                ->getRepository(UserTbl::class)
                ->findByType($type);
   
        $data = [];
   
        foreach ($users as $user) {
           $data[] = [
               'id' => $user->getId(),
               'name' => $user->getName(),
               'email' => $user->getEmail(),
               'firstname' => $user->getFirstname(),
               'lastname' => $user->getLastname(),
               'type' => $user->getType(),
           ];
        }
   
        return $this->json($data);
    }
 
    #[Route('/user/{id}', name: 'delete_user', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(UserTbl::class)->find($id);
   
        if (!$user) {
            return $this->json('No user found for id ' . $id, 404);
        }
   
        $entityManager->remove($user);
        $entityManager->flush();
   
        return $this->json('Deleted a user successfully with id ' . $id);
    }
 
}
