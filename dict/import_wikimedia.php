<?php

function write($file, $dict) {
    $file = new SplFileObject($file, 'w');

    foreach ($dict as $key => $value) {
        $file->fputcsv([$key, $value], ",");
    }
}

echo "Downloading ZhConversion.php\n";
$file = file_get_contents('https://phabricator.wikimedia.org/source/mediawiki/browse/master/languages/data/ZhConversion.php?view=raw');
if ($file === false) {
    exit('Download ZhConversion.php failed');
}

echo "Writing ZhConversion.php\n";
if (file_put_contents('ZhConversion.php', $file) === false) {
    exit('Write ZhConversion.php failed');
}

require_once 'ZhConversion.php';

echo "Writing cht.csv\n";
write('cht.csv', \MediaWiki\Languages\Data\ZhConversion::$zh2Hant);

echo "Writing chs.csv\n";
write('chs.csv', \MediaWiki\Languages\Data\ZhConversion::$zh2Hans);

echo "Writing tw.csv\n";
write('tw.csv', \MediaWiki\Languages\Data\ZhConversion::$zh2TW);

echo "Writing hk.csv\n";
write('hk.csv', \MediaWiki\Languages\Data\ZhConversion::$zh2HK);

echo "Writing cn.csv\n";
write('cn.csv', \MediaWiki\Languages\Data\ZhConversion::$zh2CN);
