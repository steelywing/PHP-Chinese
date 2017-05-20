<?php

namespace SteelyWing\Chinese;


class Chinese
{
    private $toChsDict = [];
    private $toChtDict = [];

    public function __construct($toChsFile = null, $toChtFile = null)
    {
        if ($toChsFile === null) {
            $toChsFile = __DIR__ . '/ToChs.csv';
        }

        if ($toChtFile === null) {
            $toChtFile = __DIR__ . '/ToCht.csv';
        }

        $this->toChsDict = self::load($toChsFile);
        $this->toChtDict = self::load($toChtFile);
    }

    private static function load($path)
    {
        $file = new \SplFileObject($path);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::READ_AHEAD
        );

        $dict = [];
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

        return $dict;
    }

    public function toChs($string)
    {
        return strtr($string, $this->toChsDict);
    }

    public function toCht($string)
    {
        return strtr($string, $this->toChtDict);
    }
}
