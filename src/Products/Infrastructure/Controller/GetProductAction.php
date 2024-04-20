<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Controller;

use App\Products\Application\Request\GetProductRequest;
use App\Products\Domain\Service\ProductServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/products/info', methods: ['POST'])]
class GetProductAction
{
    public function __construct(
        private readonly ProductServiceInterface $productService
    )
    {
    }

    public function __invoke(GetProductRequest $request): JsonResponse
    {
        $violations = $request->validate();

        if ($violations->count()) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }

            return new JsonResponse([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }

        $markdownedProductDTO = $this->productService->getMarkdownedProduct(
            $request->getName(),
            $request->getCouponCode(),
            $request->getTaxNumber()
        );

        return new JsonResponse($markdownedProductDTO->toArray());
    }
}
