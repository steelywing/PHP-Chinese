<?php

use \SteelyWing\Chinese\Chinese;

require_once '../Chinese.php';

$chinese = new Chinese();

echo $chinese->to('chs', "轉成簡體中文\n");
// 转成简体中文

echo $chinese->to('cht', "转成繁体中文\n");
// 轉成繁體中文
