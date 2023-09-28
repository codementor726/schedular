<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Jobs;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class JobsControllerTest extends TestCase
{
    public function testIndex()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request =  $client->request('GET', '/api/jobs');
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }

    public function testGet()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request =  $client->request('GET', '/api/job/1');
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('content', $data);
        $this->assertArrayHasKey('deadline', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('assigned', $data);
        $this->assertArrayHasKey('createdby', $data);
        $this->assertArrayHasKey('assessment', $data);
    }

    public function testDelete()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request =  $client->request('DELETE', '/api/job/1');
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }

    public function testCreate()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $data = array(
            'title' => 'test',
            'content' => 'test content',
            'deadline' => '3023-09-30',
            'status' => 1,
            'assigned' => 1,
            'createdby' => 2,
            'assessment' => 0
        );
        $request = $client->request('POST', '/api/job',[
            'form_params' => [
                'title' => 'title',
                'content' => 'test content',
                'deadline' => '3023-09-30',
                'status' => 1,
                'assigned' => 1,
                'createdby' => 2,
                'assessment' => 0
            ]
        ]);
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }

    public function testUpdate()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $data = array(
            'title' => 'test',
            'content' => 'test content',
            'deadline' => '3023-09-30',
            'status' => 1,
            'assigned' => 1,
            'createdby' => 2,
            'assessment' => 0
        );
        $request = $client->request('PUT', '/api/job/4',[
            'form_params' => [
                'title' => 'title',
                'content' => 'test content',
                'deadline' => '2023-09-30',
                'status' => 1,
                'assigned' => 1,
                'createdby' => 2,
                'assessment' => 0
            ]
        ]);
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }
}
