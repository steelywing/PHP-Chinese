<?php

namespace SteelyWing\Chinese;


class Chinese
{
    public $dictPath = __DIR__ . '/dict/';
    private $dict = [];

    public function __construct(array $dictionaries = ['chs', 'cht'])
    {
        foreach ($dictionaries as $dict) {
            $this->load($dict);
        }
    }

    public function load($locale, $path = null)
    {
        if ($path === null) {
            $path = $this->dictPath . $locale . '.csv';
        }

        $file = new \SplFileObject($path);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::READ_AHEAD
        );

        $dict = [];
        $this->dict[$locale] =& $dict;
        foreach ($file as $fields) {
            if (count($fields) != 2) {
                throw new \Exception(
                    sprintf("Cannot parse '%s' file (line %s)",
                        $file->getPathname(),
                        $file->key()
                    )
                );
            }
            $dict[$fields[0]] = $fields[1];
        }

        return $this;
    }

    public function to($locale, $string)
    {
        return strtr($string, $this->dict[$locale]);
    }
}
