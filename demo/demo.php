<?php

use SteelyWing\Chinese\Chinese;

require_once '../Chinese.php';

$chinese = new Chinese();
echo $chinese->toChs("轉成簡體中文\n");
echo $chinese->toCht("转成繁体中文\n");
