<?php

namespace Protoqol\Prequel\Interfaces;

interface GenerationInterface
{
    /**
     * GenerationInterface constructor.
     *
     * @param string $database
     * @param string $table
     */
    public function __construct(string $database, string $table);

    /**
     * Generate $generator
     *
     * @return mixed
     */
    public function generate();

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName();

    /**
     * Get class name
     *
     * @return mixed
     */
    public function getClassname();

    /**
     * Get class namespace
     *
     * @return mixed
     */
    public function getNamespace();
}
