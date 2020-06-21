<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;

class User extends ResourceController
{
	protected $format = 'json';

	public function index()
	{
		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
		$arr        = explode(' ', $authHeader);

		$token = $arr[1];

		$key = Services::getSecretKey();

		$decoded = JWT::decode($token, $key, ['HS256']);

		return $this->respond($decoded, 200);
	}
}
