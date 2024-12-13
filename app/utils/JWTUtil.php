<?php

namespace App\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\key;

class JWTUtil
{
    private $secret;
    private $algorithm;
    private $expiry;
    public function __construct($config)
    {
        $this->secret = $config['jwt_secret'];
        $this->algorithm = $config['algorithm'];
        $this->expiry = $config['expiry'];
    }

    public function generateToken($payload)
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + $this->expiry;
        $payload['jti'] = bin2hex(random_bytes(16));  // Generate a unique token ID

        return JWT::encode($payload, $this->secret, $this->algorithm);
    }

    public function verify($token, $logoutTime)
    {
        $decoded = JWT::decode($token, new Key($this->secret, $this->algorithm));
        if ($decoded->iat < strtotime($logoutTime)) {
            throw new \Exception('Token invalid due to logout');
        }
        return $decoded;
    }
}
