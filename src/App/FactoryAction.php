<?php

namespace Protoqol\Prequel\App;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Interfaces\GenerationInterface;
use Protoqol\Prequel\Traits\classResolver;

class FactoryAction implements GenerationInterface
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
     * Generate factory.
     *
     * @return int|string
     * @throws Exception
     */
    public function generate()
    {
        Artisan::call("make:factory", [
            "name" => $this->generateFactoryName($this->table),
        ]);

        $this->dumpAutoload();

        return (string)$this->getQualifiedName();
    }

    /**
     * Resolve and check seeder for table.
     *
     * @return string
     * @throws Exception
     */
    public function checkAndGetFactoryName()
    {
        $factoryFile = $this->generateFactoryName($this->table);

        if (
        !file_exists(
            base_path("database/factories/" . $factoryFile . ".php")
        )
        ) {
            throw new Exception(
                $factoryFile .
                " could not be found or your factory does not follow naming convention"
            );
        }

        return $factoryFile;
    }

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName()
    {
        try {
            return $this->checkAndGetFactoryName();
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
