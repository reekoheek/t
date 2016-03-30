<?php

namespace T;

use ROH\Util\Collection;

class T extends Collection
{
    /**
     * File extension to use as t
     * @var string
     */
    protected $extension = '.t.php';

    /**
     * Sections collected from single template generation
     * @var array
     */
    protected $sections = array();

    /**
     * Base directory to resolve templates
     * @var string
     */
    protected $baseDirectories = [
        [], [], [], [], [],
        [], [], [], [], [],
    ];

    /**
     * Constructor
     * @return void
     */
    public function __construct($baseDirectories)
    {
        if (is_string($baseDirectories)) {
            $this->baseDirectories[0][] = $baseDirectories;
        } else {
            $this->baseDirectories[0] = $baseDirectories;
        }
    }

    public function addBaseDirectory($baseDirectory, $group = 9)
    {
        $this->baseDirectories[$group][] = $baseDirectory;
    }

    /**
     * Resolve template path from template name
     * @param  string
     * @return string
     */
    public function resolve($template)
    {
        foreach ($this->baseDirectories as $baseDirectoryGroup) {
            foreach ($baseDirectoryGroup as $baseDirectory) {
                $resolved =  $baseDirectory . '/' . ltrim($template, '/') . $this->extension;
            }
            if (is_readable($resolved)) {
                return $resolved;
            }
        }
    }

    /**
     * Call this inside template if you need to extend current template
     * @param  string
     * @return void
     */
    public function extend($template)
    {
        $t = $this;
        $resolved = $this->resolve($template);
        if (!$resolved) {
            throw new \Exception('Cannot extend unresolved template: '.$template);
        }
        include $resolved;
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
    public function show($name, $data = array())
    {
        if (isset($this->sections[$name]) === true) {
            $fn = $this->sections[$name];
            $fn($data);
        }
    }

    /**
     * Render template
     * @param  string
     * @return void
     */
    public function render($template, $data = array())
    {
        $t = $this;

        $resolved = $this->resolve($template);
        if (!$resolved) {
            throw new \Exception('Cannot render unresolved template: '.$template);
        }

        include $resolved;

        if (count($this->sections) === 0) {
            throw new \Exception('No section to render for template: '.$template);
        }

        reset($this->sections);
        $name = key($this->sections);

        $fn = $this->sections[$name];
        $fn($data);
    }
}
