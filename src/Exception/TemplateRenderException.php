<?php

namespace Dhii\TwigTemplate\Exception;

use ArrayAccess;
use Dhii\Output\Exception\TemplateRenderExceptionInterface;
use Dhii\Output\RendererInterface;
use Dhii\Output\Template\TemplateInterface;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Throwable;

class TemplateRenderException extends RuntimeException implements
    TemplateRenderExceptionInterface
{
    /**
     * @var RendererInterface|null
     */
    protected $renderer;
    /**
     * @var array|ArrayAccess|object|ContainerInterface|null
     */
    protected $context;

    /**
     * @param RendererInterface|null $renderer
     * @param array|ArrayAccess|ContainerInterface|object|null $context
     */
    public function __construct(
        $message = '',
        $code = 0,
        Throwable $previous = null,
        ?RendererInterface $renderer = null,
        $context = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->renderer = $renderer;
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @inheritDoc
     */
    public function getRenderer()
    {
        return $this->renderer;
    }
}
