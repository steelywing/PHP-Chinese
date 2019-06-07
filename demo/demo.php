<?php

use SteelyWing\Chinese\Chinese;

require_once '../Chinese.php';

$chinese = new Chinese();

echo $chinese->to(Chinese::ZH_HANS, '轉成簡體中文'); // 转成简体中文
echo "\n";

echo $chinese->to(Chinese::ZH_HANT, '转成繁体中文'); // 轉成繁體中文
echo "\n";

// Set output of convert() to zh-Hans, default locale is zh-Hant
$chinese->setLocale(Chinese::ZH_HANS);
echo $chinese->convert('轉成簡體中文'); // 转成简体中文
echo "\n";

$chinese->setLocale(Chinese::ZH_HANT);
echo $chinese->convert("转成繁体中文"); // 轉成繁體中文
echo "\n";


// If you don't want to load both zh-Hant and zh-Hans dictionary

// Only load Traditional Chinese dictionary
$chinese = new Chinese([Chinese::ZH_HANT]);

// Only load Simplified Chinese dictionary
$chinese = new Chinese([Chinese::ZH_HANS]);


// WikiMedia has a zh-CN, zh-HK and zh-TW dict, default will not load this

$chinese->load('zh-CN');
echo $chinese->to('zh-CN', '網際網絡'); // 互联网
echo "\n";

$chinese->load('zh-HK');
echo $chinese->to('zh-HK', '網際網路'); // 互聯網
echo "\n";

$chinese->load('zh-TW');
echo $chinese->to('zh-TW', '存盘'); // 存檔
echo "\n";
