<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\SoapInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class SoapServerAction
{
    public function __construct(
        private SoapInterface $soapService,
        private string $soapUrl,
    ) {
    }

    #[Route('/soap', name: 'soap_server', methods: ['GET', 'POST'])]
    public function __invoke(): Response
    {
        try {
            $server = new \SoapServer(null, [
                'uri' => $this->soapUrl,
            ]);

            $server->setObject($this->soapService);

            ob_start();
            $server->handle();
            $response = ob_get_clean();

            return new Response($response, Response::HTTP_OK, ['Content-Type' => 'text/xml']);
        } catch (\Throwable $exception) {
            return new Response('SOAP Error: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}