<?php

namespace SteelyWing\Chinese;


class Chinese
{
    const CHS = 'chs';
    const CHT = 'cht';
    public $dictPath = __DIR__ . '/dict/';
    private $locale = self::CHT;
    private $dict = [];

    public function __construct(array $dictionaries = [self::CHS, self::CHT])
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

    /**
     * @param $string
     * @return string
     */
    public function convert($string)
    {
        return strtr($string, $this->dict[$this->locale]);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        if (!isset($this->dict[$locale])) {
            throw new \InvalidArgumentException("Locale not found: {$locale}");
        }
        $this->locale = $locale;
    }
}
