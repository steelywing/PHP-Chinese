<?php

function write($file, $dict) {
    echo "Writing $file\n";
    $file = new SplFileObject($file, 'w');

    foreach ($dict as $key => $value) {
        $file->fputcsv([$key, $value], ',');
    }
}

echo "Downloading ZhConversion.php\n";
$file = file_get_contents('https://phabricator.wikimedia.org/source/mediawiki/browse/master/languages/data/ZhConversion.php?view=raw');
if ($file === false) {
    exit('Download ZhConversion.php failed');
}

echo "Evalating...\n";
eval("?>$file");

use \MediaWiki\Languages\Data\ZhConversion;

write('zh-Hant.csv', ZhConversion::$zh2Hant);
write('zh-Hans.csv', ZhConversion::$zh2Hans);
write('zh-TW.csv', ZhConversion::$zh2TW);
write('zh-HK.csv', ZhConversion::$zh2HK);
write('zh-CN.csv', ZhConversion::$zh2CN);
