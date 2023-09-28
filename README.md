<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_black_02.svg">
</a></p>

This is the Symfony project which offers rest apis.

Installation
------------

* Install Symfony.
* Install composer.

API Endpoints
-------------

* /api/user/register

  POST request

  Register the user.

  Params:

    &nbsp;&nbsp;&nbsp;&nbsp;name: string;

    &nbsp;&nbsp;&nbsp;&nbsp;email: string(email format);

    &nbsp;&nbsp;&nbsp;&nbsp;firstname: string;

    &nbsp;&nbsp;&nbsp;&nbsp;lastname: string;

    &nbsp;&nbsp;&nbsp;&nbsp;type: int(0: indicator, 1: auditor);

    &nbsp;&nbsp;&nbsp;&nbsp;password: string;

* /api/user/login

  POST request

  User login.

  Params:

    &nbsp;&nbsp;&nbsp;&nbsp;email: string(email format);

    &nbsp;&nbsp;&nbsp;&nbsp;password: string;

* /api/user/{id}

  GET request

  Get User.

* /api/user/{id}

  DELETE request

  Delete User.

* /api/user/{id}

  PUT request

  Update User.

    &nbsp;&nbsp;&nbsp;&nbsp;name: string;

    &nbsp;&nbsp;&nbsp;&nbsp;email: string(email format);

    &nbsp;&nbsp;&nbsp;&nbsp;firstname: string;

    &nbsp;&nbsp;&nbsp;&nbsp;lastname: string;

    &nbsp;&nbsp;&nbsp;&nbsp;type: int(0: indicator, 1: auditor);
-------------
* /api/job

  POST request

  Create the job.

  Params:

    &nbsp;&nbsp;&nbsp;&nbsp;title: string;

    &nbsp;&nbsp;&nbsp;&nbsp;content: string;

    &nbsp;&nbsp;&nbsp;&nbsp;deadline: string;

    &nbsp;&nbsp;&nbsp;&nbsp;status: int;

    &nbsp;&nbsp;&nbsp;&nbsp;assigned: int(user id);

    &nbsp;&nbsp;&nbsp;&nbsp;createdby: int(user id);

    &nbsp;&nbsp;&nbsp;&nbsp;assessment: int;

* /api/job/{id}

  GET request

  Get Job.

* /api/job/{id}

  DELETE request

  Delete Job.

* /api/job/{id}

  PUT request

  Update Job.

  Params:

  &nbsp;&nbsp;&nbsp;&nbsp;Same with create Job API

* /api/jobs

  GET request

  Get Job list.

About
-------------

Contact me by email to metor.selfworker@gmail.com
