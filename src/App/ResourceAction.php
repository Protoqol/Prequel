<?php

namespace Protoqol\Prequel\App;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Interfaces\GenerationInterface;
use Protoqol\Prequel\Traits\classResolver;

class ResourceAction implements GenerationInterface
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
     * Generate resource
     *
     * @return mixed
     */
    public function generate()
    {
        Artisan::call("make:resource", [
            "name" => $this->generateResourceName($this->table),
        ]);

        $this->dumpAutoload();

        return (string)$this->getQualifiedName();
    }

    /**
     * Resolve and check resource for table.
     *
     * @return string
     * @throws Exception
     */
    private function checkAndGetResourceName()
    {
        $resourceClass =
            "App\\Http\\Resources\\" .
            $this->generateResourceName($this->table);

        if (!$this->classExists($resourceClass)) {
            throw new Exception(
                $resourceClass .
                " could not be found or your resource does not follow naming convention"
            );
        }

        return $resourceClass;
    }

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName()
    {
        try {
            return $this->checkAndGetResourceName();
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
        $class = $this->getQualifiedName();

        if (!$class) {
            return false;
        }

        $arr = explode("\\", $class);
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
        $class = $this->getQualifiedName();

        if (!$class) {
            return false;
        }

        $arr = explode("\\", $class);
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
