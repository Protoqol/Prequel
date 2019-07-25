<?php

namespace Protoqol\Prequel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PDB
 * @package Protoqol\Prequel\Facades
 */
class PDB extends Facade
{

    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor() { return 'prequeldb'; }

}
