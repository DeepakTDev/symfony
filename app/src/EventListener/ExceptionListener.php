<?php

namespace App\EventListener;

use App\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $this->logException($exception);
        $response = $this->createApiResponse($event->getThrowable());
        $event->setResponse($response);
    }

    private function createApiResponse(\Exception $exception): ApiResponse
    {
        return new ApiResponse('known_error', $exception->getMessage(), null, null, $exception instanceof HttpException ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function logException(\Exception $exception): void
    {
        if (!$exception instanceof HttpException || $exception->getStatusCode() >= Response::HTTP_INTERNAL_SERVER_ERROR) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }
    }
}
