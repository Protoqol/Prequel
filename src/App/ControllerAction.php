<?php

namespace Protoqol\Prequel\App;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Interfaces\GenerationInterface;
use Protoqol\Prequel\Traits\classResolver;

class ControllerAction implements GenerationInterface
{
    use classResolver;

    /**
     * @var string $database
     */
    private $database;

    /**
     * @var string $table
     */
    private $table;

    /**
     * ControllerAction constructor.
     *
     * @param string $database
     * @param string $table
     */
    public function __construct(string $database, string $table)
    {
        $this->database = $database;
        $this->table = $table;
    }

    /**
     * Generate controller
     *
     * @return mixed
     * @throws Exception
     */
    public function generate()
    {
        Artisan::call("make:controller", [
            "name" => $this->generateControllerName($this->table),
        ]);

        $this->dumpAutoload();

        return (string)$this->getQualifiedName();
    }

    /**
     * Resolve and check controller for table
     *
     * @return string
     * @throws Exception
     */
    private function checkAndGetControllerName()
    {
        $controllerClass =
            "App\\Http\\Controllers\\" .
            $this->generateControllerName($this->table);

        if (!$this->classExists($controllerClass)) {
            throw new Exception(
                $controllerClass .
                " could not be found or your controller does not follow naming convention"
            );
        }

        return $controllerClass;
    }

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName()
    {
        try {
            return $this->checkAndGetControllerName();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get class name
     *
     * @return mixed
     */
    public function getClassname()
    {
        $arr = explode("\\", $this->getQualifiedName());
        $count = count($arr);

        return $arr[$count - 1];
    }

    /**
     * Get class namespace
     *
     * @return mixed
     */
    public function getNamespace()
    {
        $arr = explode("\\", $this->getQualifiedName());
        $count = count($arr);
        $namespace = "";

        for ($i = 0; $i < $count; $i++) {
            if ($i === $count - 1) {
                break;
            }
            $namespace .= (string)$arr[$i] . "\\";
        }

        return $namespace;
    }
}
