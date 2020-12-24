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
     * @var RendererInterface
     */
    protected $renderer;
    /**
     * @var array|ArrayAccess|ContainerInterface
     */
    protected $context;

    /**
     * @param RendererInterface $renderer
     * @param array|ArrayAccess|ContainerInterface $context
     */
    public function __construct(
        RendererInterface $renderer,
        $context,
        $message = '',
        $code = 0,
        Throwable $previous = null
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
