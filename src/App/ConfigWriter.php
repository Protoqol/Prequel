<?php
/**
 * Configuration writer
 * Author: https://github.com/daftspunk
 * Source: https://github.com/daftspunk/laravel-config-writer/blob/master/src/DataWriter/Rewrite.php
 * This class lets you rewrite array values inside a basic configuration file
 * that returns a single array definition (a Laravel config file) whilst maintaining
 * the integrity of the file, leaving comments and advanced settings intact.
 * The following value types are supported for writing:
 * - strings
 * - integers
 * - booleans
 * - nulls
 * - single-dimension arrays
 * To do:
 * - When an entry does not exist, provide a way to create it
 * Pro Regex tip: Use [\s\S] instead of . for multiline support
 */

namespace Protoqol\Prequel\App;

use Exception;

class ConfigWriter
{
    /**
     * Write to config file
     *
     * @param string $filePath
     * @param array $newValues
     * @param bool $useValidation
     *
     * @return string
     */
    public function toFile(
        string $filePath,
        array $newValues,
        bool $useValidation = true
    ): string
    {
        $contents = file_get_contents($filePath);

        try {
            $contents = $this->toContent($contents, $newValues, $useValidation);
            file_put_contents($filePath, $contents);
        } catch (Exception $e) {
            return $e;
        }

        return $contents;
    }

    public function toContent(
        string $contents,
        array $newValues,
        bool $useValidation = true
    ): string
    {
        $contents = $this->parseContent($contents, $newValues);

        if (!$useValidation) {
            return $contents;
        }

        $result = eval("?>" . $contents);

        foreach ($newValues as $key => $expectedValue) {
            $parts = explode(".", $key);

            $array = $result;
            foreach ($parts as $part) {
                if (!is_array($array) || !array_key_exists($part, $array)) {
                    throw new Exception(
                        sprintf(
                            'Unable to rewrite key "%s" in config, does it exist?',
                            $key
                        )
                    );
                }

                $array = $array[$part];
            }
            $actualValue = $array;

            if ($actualValue != $expectedValue) {
                throw new Exception(
                    sprintf(
                        'Unable to rewrite key "%s" in config, rewrite failed',
                        $key
                    )
                );
            }
        }

        return $contents;
    }

    protected function parseContent(string $contents, array $newValues): string
    {
        $result = $contents;

        foreach ($newValues as $path => $value) {
            $result = $this->parseContentValue($result, $path, $value);
        }

        return $result;
    }

    protected function parseContentValue(
        string $contents,
        string $path,
        $value
    ): string
    {
        $result = $contents;
        $items = explode(".", $path);
        $key = array_pop($items);
        $replaceValue = $this->writeValueToPhp($value);

        $count = 0;
        $patterns = [];
        $patterns[] = $this->buildStringExpression($key, $items);
        $patterns[] = $this->buildStringExpression($key, $items, '"');
        $patterns[] = $this->buildConstantExpression($key, $items);
        $patterns[] = $this->buildArrayExpression($key, $items);

        foreach ($patterns as $pattern) {
            $result = preg_replace(
                $pattern,
                '${1}${2}' . $replaceValue,
                $result,
                1,
                $count
            );

            if ($count > 0) {
                break;
            }
        }

        return $result;
    }

    protected function writeValueToPhp($value): string
    {
        if (is_string($value) && strpos($value, "'") === false) {
            $replaceValue = "'" . $value . "'";
        } elseif (is_string($value) && strpos($value, '"') === false) {
            $replaceValue = '"' . $value . '"';
        } elseif (is_bool($value)) {
            $replaceValue = $value ? "true" : "false";
        } elseif (is_null($value)) {
            $replaceValue = "null";
        } elseif (
            is_array($value) &&
            count($value) === count($value, COUNT_RECURSIVE)
        ) {
            $replaceValue = $this->writeArrayToPhp($value);
        } else {
            $replaceValue = $value;
        }

        $replaceValue = str_replace('$', '\$', $replaceValue);

        return $replaceValue;
    }

    protected function writeArrayToPhp(array $array): array
    {
        $result = [];

        foreach ($array as $value) {
            if (!is_array($value)) {
                $result[] = $this->writeValueToPhp($value);
            }
        }

        return "[" . implode(", ", $result) . "]";

        return $result;
    }

    protected function buildStringExpression(
        string $targetKey,
        array $arrayItems = [],
        string $quoteChar = "'"
    ): string
    {
        $expression = [];

        // Opening expression for array items ($1)
        $expression[] = $this->buildArrayOpeningExpression($arrayItems);

        // The target key opening
        $expression[] =
            '([\'|"]' . $targetKey . '[\'|"]\s*=>\s*)[' . $quoteChar . "]";

        // The target value to be replaced ($2)
        $expression[] = "([^" . $quoteChar . "]*)";

        // The target key closure
        $expression[] = "[" . $quoteChar . "]";

        return "/" . implode("", $expression) . "/";
    }

    /**
     * Common constants only (true, false, null, integers)
     */
    protected function buildConstantExpression(
        string $targetKey,
        array $arrayItems = []
    ): string
    {
        $expression = [];

        // Opening expression for array items ($1)
        $expression[] = $this->buildArrayOpeningExpression($arrayItems);

        // The target key opening ($2)
        $expression[] = '([\'|"]' . $targetKey . '[\'|"]\s*=>\s*)';

        // The target value to be replaced ($3)
        $expression[] =
            "([tT][rR][uU][eE]|[fF][aA][lL][sS][eE]|[nN][uU][lL]{2}|[\d]+)";

        return "/" . implode("", $expression) . "/";
    }

    /**
     * Single level arrays only
     */
    protected function buildArrayExpression(
        string $targetKey,
        array $arrayItems = []
    ): string
    {
        $expression = [];

        // Opening expression for array items ($1)
        $expression[] = $this->buildArrayOpeningExpression($arrayItems);

        // The target key opening ($2)
        $expression[] = '([\'|"]' . $targetKey . '[\'|"]\s*=>\s*)';

        // The target value to be replaced ($3)
        $expression[] = "(?:[aA][rR]{2}[aA][yY]\(|[\[])([^\]|)]*)[\]|)]";

        return "/" . implode("", $expression) . "/";
    }

    protected function buildArrayOpeningExpression(array $arrayItems): string
    {
        if (count($arrayItems)) {
            $itemOpen = [];
            foreach ($arrayItems as $item) {
                // The left hand array assignment
                $itemOpen[] =
                    '[\'|"]' .
                    $item .
                    '[\'|"]\s*=>\s*(?:[aA][rR]{2}[aA][yY]\(|[\[])';
            }

            // Capture all opening array (non greedy)
            $result = "(" . implode("[\s\S]*?", $itemOpen) . "[\s\S]*?)";
        } else {
            // Gotta capture something for $1
            $result = "()";
        }

        return $result;
    }
}
