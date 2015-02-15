<?php

namespace T;

class T
{
    /**
     * File extension to use as t
     * @var string
     */
    protected $extension = '.php';

    /**
     * Sections collected from single template generation
     * @var array
     */
    protected $sections = array();

    /**
     * Base directory to resolve templates
     * @var string
     */
    protected $baseDirectory;

    /**
     * Constructor
     * @return void
     */
    public function __construct($baseDirectory)
    {
        $this->baseDirectory = $baseDirectory;
    }

    /**
     * Resolve template path from template name
     * @param  string
     * @return string
     */
    public function resolve($template)
    {
        return $this->baseDirectory . '/' . $template.$this->extension;
    }

    /**
     * Call this inside template if you need to extend current template
     * @param  string
     * @return void
     */
    public function extend($template)
    {
        $t = $this;
        include $this->resolve($template);
    }

    /**
     * Call this inside template to add new section
     * @param  string
     * @param  Callable
     * @return void
     */
    public function section($name, $fn)
    {
        $this->sections[$name] = $fn;
    }

    /**
     * Call this inside template to show section
     * @param  string
     * @return void
     */
    public function show($name)
    {
        if (isset($this->sections[$name]) === true) {
            $fn = $this->sections[$name];
            $fn();
        }
    }

    /**
     * Render template
     * @param  string
     * @return void
     */
    public function render($template)
    {
        $t = $this;
        include $this->resolve($template);

        reset($this->sections);
        $name = key($this->sections);
        $fn = $this->sections[$name];

        $fn();
    }
}