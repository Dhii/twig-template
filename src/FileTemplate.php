<?php

namespace Dhii\TwigTemplate;

use Dhii\Output\Template\TemplateInterface;
use Dhii\TwigTemplate\Exception\TemplateRenderException;
use Exception;
use InvalidArgumentException;
use Traversable;
use Twig\TemplateWrapper;

class FileTemplate implements TemplateInterface
{
    /**
     * @var TemplateWrapper
     */
    protected $twigTemplate;

    public function __construct(TemplateWrapper $twigTemplate)
    {
        $this->twigTemplate = $twigTemplate;
    }

    /**
     * @inheritDoc
     */
    public function render($context = null)
    {
        $context = $this->normalizeContext($context);

        try {
            return $this->twigTemplate->render($context);
        } catch (Exception $e) {
            throw new TemplateRenderException($this->__('Could not render template'), 0, $e, $this, $context);
        }
    }

    /**
     * Normalizes context to a canonical representation.
     *
     * @param array|iterable|object $context The context to normalize.
     * @return array The canonical representation of the context.
     * @throws InvalidArgumentException If context cannot be normalized.
     */
    protected function normalizeContext($context): array
    {
        if (is_object($context)) {
            $context = (array) $context;
        }

        if ($context instanceof Traversable) {
            $context = iterator_to_array($context);
        }

        if (!is_array($context)) {
            throw new InvalidArgumentException($this->__('Context must be an array; %1$s given', [gettype($context)]));
        }

        return $context;
    }

    /**
     * Translates a string and interpolates values.
     *
     * The values in the string may be specified using the {@see sprintf()} style.
     *
     * @param string $string The string to translate.
     * @param array $placeholders Numeric array. The values to replace placeholders in the string with.
     *
     * @throws Exception If problem translating.
     *
     * @return string The translated string, with placeholders replaced.
     */
    protected function __(string $string, $placeholders = []): string
    {
        return vsprintf($string, $placeholders);
    }
}
