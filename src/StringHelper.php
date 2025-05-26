<?php

namespace Jemer\StringHelper;

class StringHelper
{
    /**
     * Check if a string contains a given substring.
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return mb_strpos($haystack, $needle) !== false;
    }
    /**
     * Convert string to uppercase.
     */
    public static function toUpper(string $input): string
    {
        return mb_strtoupper($input);
    }

    /**
     * Convert string to lowercase.
     */
    public static function toLower(string $input): string
    {
        return mb_strtolower($input);
    }

    /**
     * Convert a string to snake_case.
     */
    public static function toSnakeCase(string $input): string
    {
        $input = preg_replace('/[A-Z]/', '_$0', $input);
        return strtolower(ltrim($input, '_'));
    }

    /**
     * Convert a string to camelCase.
     */
    public static function toCamelCase(string $input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $input))));
    }

    /**
     * Limit string length and append ending.
     */
    public static function limit(string $str, int $limit): string
    {
        $ellipsis = '...';
        if (strlen($str) <= $limit) {
            return $str;
        }

        return substr($str, 0, $limit - strlen($ellipsis)) . $ellipsis;
    }

    /**
     * Check if string starts with a given substring.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return strncmp($haystack, $needle, strlen($needle)) === 0;
    }

    /**
     * Check if string ends with a given substring.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        return substr($haystack, -strlen($needle)) === $needle;
    }

    /**
     * Converts a string to a slug
     */
    public static function slugify(string $text, string $separator = '-'): string
    {
        $text = preg_replace('~[^\pL\d]+~u', $separator, $text);

        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        $text = preg_replace('~[^\\'.$separator.'\w]+~', '', $text);

        $text = trim($text, $separator);

        $text = preg_replace('~'.preg_quote($separator, '~').'+~', $separator, $text);

        $text = strtolower($text);

        return $text ?: ('n' . $separator . 'a');
    }


}
