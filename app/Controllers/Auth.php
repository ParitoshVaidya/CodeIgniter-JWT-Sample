<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;

class Auth extends ResourceController
{

	protected $format = 'json';

	public function create()
	{
		/**
		 * JWT claim types
		 * https://auth0.com/docs/tokens/concepts/jwt-claims#reserved-claims
		 */

		$email    = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		// add code to fetch through db and check they are valid
		// sending no email and password also works here because both are empty
		if ($email === $password)
		{
			$key     = Services::getSecretKey();
			$payload = [
				'aud' => 'http://example.com',
				'iat' => 1356999524,
				'nbf' => 1357000000,
			];

			/**
			 * IMPORTANT:
			 * You must specify supported algorithms for your application. See
			 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
			 * for a list of spec-compliant algorithms.
			 */
			$jwt = JWT::encode($payload, $key);
			return $this->respond(['token' => $jwt], 200);
		}

		return $this->respond(['message' => 'Invalid login details'], 401);
	}
}
