<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;

class User extends ResourceController
{
	protected $format = 'json';

	public function index()
	{
		// fetch records from db as per requirements
		$exampleUser = [
			'name' => 'example user',
			'address' => 'example address'
		];

		return $this->respond($exampleUser, 200);
	}
}
