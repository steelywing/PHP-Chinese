<?php

$files = [
    'cht.csv' => [
        'OpenCC/data/dictionary/STCharacters.txt',
        'OpenCC/data/dictionary/STPhrases.txt',
    ],
    'chs.csv' => [
        'OpenCC/data/dictionary/TSCharacters.txt',
        'OpenCC/data/dictionary/TSPhrases.txt',
    ]
];

function read($path)
{
    // load dictionary file
    $dict = [];

    $file = new SplFileObject($path);
    $file->setFlags(SplFileObject::SKIP_EMPTY);

    if ($file === false) {
        throw new Exception("Open file '$path' fail");
    }

    while (!$file->eof()) {
        $row = trim($file->fgets());
        if ($row == '') {
            continue;
        }

        // split and remove line break
        $fields = explode("\t", $row);

        if (count($fields) !== 2) {
            $line = $file->key();
            throw new Exception("[$line] '$row' not correct");
        }

        $fields[1] = explode(' ', $fields[1]);

        $dict[$fields[0]] = $fields[1];
    }

    return $dict;
}

function write($file, $dict) {
    $file = new SplFileObject($file, 'w');

    $dict = array_map(function (&$value) {
        return $value[0];
    }, $dict);

    foreach ($dict as $key => $value) {
        // $file->fwrite("$key\t$value\n");
        $file->fputcsv([$key, $value]);
    }
}

foreach ($files as $out => $in) {
    $inputs = array_map(function ($in) {
        print "Loading '$in'...\n";
        return read($in);
    }, $in);

    $output = [];
    foreach ($inputs as &$input) {
        $output += $input;
    }

    print "Writing '$out'...\n";
    write($out, $output);
}
