<?php


namespace Dhii\TwigTemplate;


use Dhii\Output\Template\PathTemplateFactoryInterface;
use Dhii\Output\Template\TemplateInterface;
use Twig\Environment;

class FileTemplateFactory implements PathTemplateFactoryInterface
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @param Environment $environment The Twig environment to use for new templates.
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @inheritDoc
     */
    public function fromPath(string $templatePath): TemplateInterface
    {
        $twigTemplate = $this->environment->load($templatePath);
        $template = new FileTemplate($twigTemplate);

        return $template;
    }
}
