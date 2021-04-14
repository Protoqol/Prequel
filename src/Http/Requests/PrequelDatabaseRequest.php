<?php

namespace Protoqol\Prequel\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Protoqol\Prequel\Database\DatabaseTraverser;

/**
 * Class PrequelDatabaseRequest
 *
 * @property mixed database
 * @property mixed table
 * @property mixed model
 * @property mixed qualifiedName
 * @package Protoqol\Prequel\Http\Requests
 */
class PrequelDatabaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "database"      => "string",
            "table"         => "string",
            "qualifiedName" => "string",
        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return Validator
     */
    public function getValidatorInstance()
    {
        $request = $this->validationData();

        try {
            $request["database"] = $this->route("database");
            $request["table"] = $this->route("table");

            $request["qualifiedName"] =
                $request["database"] . "." . $request["table"];

            $request["model"] = app(DatabaseTraverser::class)->getModel(
                $request["table"]
            )["model"];
        } catch (Exception $exception) {
            return parent::getValidatorInstance();
        }

        $this->getInputSource()->replace($request);

        return parent::getValidatorInstance();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "database.required"      => "Database name is required",
            "table.required"         => "Table name is required",
            "qualifiedName.required" =>
                "Could not construct sensible table name.",
        ];
    }
}
