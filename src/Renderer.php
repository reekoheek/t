<?php

namespace T;

use Exception;
use Bono\Http\Context;
use Bono\Renderer\RendererInterface;
use Bono\App;

class Renderer implements RendererInterface
{
    protected $app;

    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    protected function createT()
    {
        $templatePaths = $this->options['middleware']['templatePaths'];
        $templatePaths[] = __DIR__.'/../templates';

        return new T($templatePaths);
    }

    public function resolve($template, $t = null)
    {
        $t = $t ?: $this->createT();

        $segments = explode('/', $template);
        if (2 === count($segments)) {
            $resolved = $t->resolve($template);

            if (null === $resolved) {
                $template = '__shared__/'.$segments[1];
                $resolved = $t->resolve($template);
            }

            if (null !== $resolved) {
                return [$template, $resolved];
            }
        } else {
            $resolved = $t->resolve($template);
            if (null !== $resolved) {
                return [$template, $resolved];
            }
        }
    }

    public function write(Context $context)
    {
        $t = $this->createT();

        $resolved = $this->resolve($context['@renderer.template'], $t);
        if (null === $resolved) {
            throw new Exception('Template not found: ' . $context['@renderer.template']);
        }
        $t->delegate($context);
        $t['context'] = $context;
        $t['bundle'] = $context['route.bundle'];
        $t->write($resolved[0], $context->getState(), $context);
    }

    public function render($template, array $data = []) {
        $t = $this->createT();

        return $t->render($template, $data);
    }
}
