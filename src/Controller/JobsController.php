<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Jobs;

#[Route('/api', name: 'api_')]
class JobsController extends AbstractController
{
    #[Route('/jobs', name: 'get_jobs', methods:['get'])]
    public function index(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $jobs = $doctrine
            ->getRepository(Jobs::class)
            ->findAll();
        $data = [];
   
        foreach ($jobs as $job) {
           $data[] = [
                'id' => $job->getId(),
                'title' => $job->getTitle(),
                'content' => $job->getContent(),
                'deadline' => $job->getDeadline(),
                'status' => $job->getStatus(),
                'assigned' => $job->getAssigned(),
                'createdby' => $job->getCreatedBy(),
                'assessment' => $job->getAssessment(),
           ];
        }
   
        return $this->json($data);
    } 

    #[Route('/job', name: 'create_job', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
   
        $job = new Jobs();
        $job->setTitle($request->request->get('title'));
        $job->setContent($request->request->get('content'));
        $job->setDeadline($request->request->get('deadline'));
        $job->setStatus($request->request->get('status'));
        $job->setAssigned($request->request->get('assigned'));
        $job->setCreatedBy($request->request->get('createdby'));
        $job->setAssessment($request->request->get('assessment'));
   
        $entityManager->persist($job);
        $entityManager->flush();
   
        $data =  [
            'id' => $job->getId(),
            'title' => $job->getTitle(),
            'content' => $job->getContent(),
            'deadline' => $job->getDeadline(),
            'status' => $job->getStatus(),
            'assigned' => $job->getAssigned(),
            'createdby' => $job->getCreatedBy(),
            'assessment' => $job->getAssessment(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/job/{id}', name: 'get_job', methods:['get'] )]
    public function get(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $job = $doctrine->getRepository(Jobs::class)->find($id);
   
        if (!$job) {
            return $this->json('No job found for id ' . $id, 404);
        }
   
        $data =  [
            'id' => $job->getId(),
            'title' => $job->getTitle(),
            'content' => $job->getContent(),
            'deadline' => $job->getDeadline(),
            'status' => $job->getStatus(),
            'assigned' => $job->getAssigned(),
            'createdby' => $job->getCreatedBy(),
            'assessment' => $job->getAssessment(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/job/{id}', name: 'delete_job', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $job = $entityManager->getRepository(Jobs::class)->find($id);
   
        if (!$job) {
            return $this->json('No user found for id ' . $id, 404);
        }
   
        $entityManager->remove($job);
        $entityManager->flush();
   
        return $this->json('Deleted a job successfully with id ' . $id);
    }
 
    #[Route('/job/{id}', name: 'update_job', methods:['put', 'patch'] )]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $job = $entityManager->getRepository(Jobs::class)->find($id);
   
        if (!$job) {
            return $this->json('No job found for id ' . $id, 404);
        }
   
        $job->setTitle($request->request->get('title'));
        $job->setContent($request->request->get('content'));
        $job->setDeadline($request->request->get('deadline'));
        $job->setStatus($request->request->get('status'));
        $job->setAssigned($request->request->get('assigned'));
        $job->setCreatedBy($request->request->get('createdby'));
        $job->setAssessment($request->request->get('assessment'));
        $entityManager->flush();
   
        $data =  [
            'title' => $job->getTitle(),
            'content' => $job->getContent(),
            'deadline' => $job->getDeadline(),
            'status' => $job->getStatus(),
            'assigned' => $job->getAssigned(),
            'createdby' => $job->getCreatedBy(),
            'assessment' => $job->getAssessment(),
        ];
           
        return $this->json($data);
    }
}
