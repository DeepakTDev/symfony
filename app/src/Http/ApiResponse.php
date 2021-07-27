<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse extends JsonResponse
{
    /**
     * ApiResponse constructor.
     *
     * @param mixed $data
     */
    public function __construct(string $messageKey, ?string $message = null, ?array $data = null, $errors = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = [], bool $json = false)
    {
        parent::__construct($this->format($messageKey, $message, $data, $errors), $statusCode, $headers, $json);
    }

    private function format(string $messageKey, ?string $message = null, $data = null, $errors = null): array
    {
        return [
            'message_key' => $messageKey,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ];
    }
}
