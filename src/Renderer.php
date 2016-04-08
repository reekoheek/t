<?php

namespace T;

use Exception;
use Bono\Http\Context;
use Bono\Renderer\RendererInterface;

class Renderer implements RendererInterface
{
    protected $options;

    protected $t;

    public function __construct($options)
    {
        $this->options = $options;
    }

    protected function getT()
    {
        if (is_null($this->t)) {
            $this->t = new T($this->options['middleware']['templatePaths']);
        }

        return $this->t;
    }

    public function resolve($template)
    {
        $segments = explode('/', $template);
        if (2 === count($segments)) {
            $resolved = $this->getT()->resolve($template);
            if (is_null($resolved)) {
                $resolved = $this->getT()->resolve('shared/'.$segments[1]);
            }

            if (isset($resolved)) {
                return ['shared/'.$segments[1], $resolved];
            }
        } else {
            $resolved = $this->getT()->resolve($template);
            if (isset($resolved)) {
                return [$template, $resolved];
            }
        }
    }

    public function write(Context $context)
    {
        $resolved = $this->resolve($context['response.template']);
        if (is_null($resolved)) {
            throw new Exception('Template not found: ' . $context['response.template']);
        }
        $t = $this->getT();
        $t['context'] = $context;
        $t['bundle'] = $context['route.bundle']->getHandler();
        $t->write($resolved[0], $context->getState(), $context);
    }

    public function render($template, array $data = []) {
        return $this->getT()->render($template, $data);
    }
}
