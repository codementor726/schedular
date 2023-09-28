<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UserTbl;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class UserControllerTest extends TestCase
{
    public function testgetList1()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request =  $client->request('GET', '/api/users/0');
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
        $request =  $client->request('GET', '/api/user/1');
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('firstname', $data);
        $this->assertArrayHasKey('lastname', $data);
        $this->assertArrayHasKey('type', $data);
    }

    public function testDelete()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request =  $client->request('DELETE', '/api/user/6');
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
        $request = $client->request('POST', '/api/user/register',[
            'form_params' => [
                'name' => 'john8392029',
                'email' => 'john@disl.com',
                'firstname' => 'john',
                'lastname' => 'terry',
                'type' => 1,
                'password' => '123123123'
            ]
        ]);
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }

    public function testLogin()
    {
        $client = new Client([
            'base_uri' => 'http://192.168.2.32:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $request = $client->request('POST', '/api/user/login',[
            'form_params' => [
                'email' => 'john@disl.com',
                'password' => '123123123'
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
        $request = $client->request('PUT', '/api/user/6',[
            'form_params' => [
                'name' => 'john123',
                'email' => 'john@disl.com',
                'firstname' => 'john',
                'lastname' => 'terry',
                'type' => 1,
                'password' => '123123123'
            ]
        ]);
        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(true), true);
    }
}
