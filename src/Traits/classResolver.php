<?php

namespace Protoqol\Prequel\Traits;

use Illuminate\Support\Str;

trait classResolver
{
    /**
     * Dump composer's autoload.
     *
     * @return int
     */
    public function dumpAutoload(): int
    {
        $out    = [];
        $return = 0;

        exec("cd " . base_path() . " && composer dump-autoload", $out, $return);

        return $return;
    }

    /**
     * Check for class existence.
     *
     * @param  string  $classname
     * @param  array|null  $namespaces
     *
     * @return bool|string
     */
    public function classExists(string $classname, array $namespaces = null)
    {
        if (!$namespaces) {
            return class_exists($classname);
        }

        foreach ($namespaces as $namespace) {
            $qualifiedClassName = $namespace . $classname;
            if (class_exists($qualifiedClassName)) {
                return $qualifiedClassName;
            }
        }

        return false;
    }

    /**
     * Resolve and return configured suffixes from the config.
     * Returns object with suffix and namespace or an empty string.
     *
     * @param  string  $generator  ex. 'model', 'controller', 'resource' etc.
     *
     * @return object
     */
    public function configNamespaceResolver(string $generator): object
    {
        $config    = config("prequel.suffixes")[$generator];
        $exploded  = explode("\\", $config);
        $suffix    = end($exploded);
        $namespace = $suffix
            ? substr($config, 0, 0 - strlen($suffix))
            : $config;

        return (object) compact('suffix', 'namespace');
    }

    /**
     * Transform table name to a SingularStudlyClassName.
     *
     * @param  string  $classname
     *
     * @return string
     */
    public function generateClassName(string $classname): string
    {
        return Str::studly(Str::singular($classname));
    }

    /**
     * @param  string  $classname
     *
     * @return string
     */
    public function generateControllerName(string $classname): string
    {
        $config = $this->configNamespaceResolver("controller");

        return $config->namespace .
            $this->generateClassName($classname) .
            $config->suffix;
    }

    /**
     * @param  string  $classname
     *
     * @return string
     */
    public function generateFactoryName(string $classname): string
    {
        $config = $this->configNamespaceResolver("factory");

        return $config->namespace .
            $this->generateClassName($classname) .
            $config->suffix;
    }

    /**
     * @param  string  $classname
     *
     * @return string
     */
    public function generateModelName(string $classname): string
    {
        $config = $this->configNamespaceResolver("model");

        return app()->getNamespace() .
            $config->namespace .
            $this->generateClassName($classname) .
            $config->suffix;
    }

    /**
     * @param  string  $classname
     *
     * @return string
     */
    public function generateResourceName(string $classname): string
    {
        $config = $this->configNamespaceResolver("resource");

        return $config->namespace .
            $this->generateClassName($classname) .
            $config->suffix;
    }

    /**
     * @param  string  $classname
     *
     * @return string
     */
    public function generateSeederName(string $classname): string
    {
        $config = $this->configNamespaceResolver("seeder");

        return $config->namespace .
            $this->generateClassName($classname) .
            $config->suffix;
    }
}
