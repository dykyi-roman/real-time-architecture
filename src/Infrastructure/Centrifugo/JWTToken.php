<?php

declare(strict_types=1);

namespace App\Infrastructure\Centrifugo;

final class JWTToken
{
    public function generateToken(int $userId = 0, array $permissions = []): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload = [
            'sub' => (string)$userId,
            'permissions' => $permissions,
        ];

        $segments = [];
        $segments[] = $this->urlsafeB64Encode(json_encode($header));
        $segments[] = $this->urlsafeB64Encode(json_encode($payload));
        $signing_input = implode('.', $segments);
        $signature = $this->sign($signing_input, 'my-secret-token');
        $segments[] = $this->urlsafeB64Encode($signature);

        return implode('.', $segments);
    }

    private function urlsafeB64Encode(string $input): array|string
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    private function sign($msg, $key): string
    {
        return hash_hmac('sha256', $msg, $key, true);
    }
}
