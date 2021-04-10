<?php

namespace Protoqol\Prequel\App;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Interfaces\GenerationInterface;
use Protoqol\Prequel\Traits\classResolver;

class SeederAction implements GenerationInterface
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
     * Generate seeder.
     *
     * @return int|string
     */
    public function generate()
    {
        Artisan::call("make:seeder", [
            "name" => $this->generateClassName($this->table) . "Seeder",
        ]);

        $this->dumpAutoload();

        return (string)$this->getQualifiedName();
    }

    /**
     * Run seeder.
     *
     * @return int
     * @throws Exception
     */
    public function run()
    {
        return Artisan::call("db:seed", [
            "--class"    => $this->checkAndGetSeederName(),
            "--database" => $this->database,
        ]);
    }

    /**
     * Resolve and check seeder for table.
     *
     * @return string
     * @throws Exception
     */
    private function checkAndGetSeederName()
    {
        $seederClass = $this->generateSeederName($this->table);

        if (!$this->classExists($seederClass)) {
            throw new Exception(
                $seederClass .
                " could not be found or your seeder does not follow naming convention"
            );
        }

        return $seederClass;
    }

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName()
    {
        try {
            return $this->checkAndGetSeederName();
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
