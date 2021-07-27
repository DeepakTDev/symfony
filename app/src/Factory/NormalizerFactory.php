<?php

namespace App\Factory;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class NormalizerFactory
{
    /**
     * @var ContextAwareNormalizerInterface[]
     */
    private iterable $normalizers;

    /**
     * NormalizerFactory constructor.
     */
    public function __construct(iterable $normalizers)
    {
        $this->normalizers = $normalizers;
    }

    /**
     * Returns the normalizer by supported data.
     *
     * @param mixed $data
     */
    public function getNormalizer($data): ?ContextAwareNormalizerInterface
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof ContextAwareNormalizerInterface && $normalizer->supportsNormalization($data)) {
                return $normalizer;
            }
        }

        return null;
    }
}
