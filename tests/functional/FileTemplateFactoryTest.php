<?php

namespace Dhii\TwigTemplate\Test\functional;

use Dhii\TwigTemplate\FileTemplateFactory as Subject;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class FileTemplateFactoryTest extends TestCase
{
    const TEMPLATE_PATH_SIMPLE = ROOT_DIR . '/tests/stub/simple.twig';

    protected $environment;

    /**
     * @param string $templatePath Path to the template file.
     *
     * @return Subject|MockObject
     */
    protected function createSubject(Environment $environment): Subject
    {
        $mock = $this->getMockBuilder(Subject::class)
            ->enableProxyingToOriginalMethods()
            ->setConstructorArgs([$environment])
            ->getMock();

        return $mock;
    }

    public function testTemplate()
    {
        {
            $env = $this->getEnvironment();
            $templatePath = self::TEMPLATE_PATH_SIMPLE;
            $message = uniqid('message');
            $data = [
                'message' => $message,
            ];
            $subject = $this->createSubject($env);
        }

        {
            $template = $subject->fromPath($templatePath);
            $result = $template->render($data);
            $this->assertEquals($this->renderTemplate($templatePath, $data), $result);
        }
    }

    protected function renderTemplate(string $filePath, array $context): string
    {
        $env = $this->getEnvironment();
        $template = $env->load($filePath);
        $output = $template->render($context);

        return $output;
    }

    protected function getEnvironment(): Environment
    {
        if (!($this->environment instanceof Environment)) {
            $loader = new FilesystemLoader(
                [
                    '__main__' => '//',
                ], '//'
            );
            $this->environment = new Environment($loader, []);
        }

        return $this->environment;
    }
}
