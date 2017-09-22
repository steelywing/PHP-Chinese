# Chinese Conversion
PHP Chinese Conversion, Simple, Lightweight

## Installation
### Composer
Run `composer require steelywing/chinese`

### Manually
Clone this repo, run `composer dump-autoload` on root directory to 
generate `autoload.php`.

## Feature
- Use WikiMedia or OpenCC library

## Demo
```php
use SteelyWing\Chinese\Chinese;

$chinese = new Chinese();

// 转成简体中文
echo $chinese->to(Chinese::CHS, "轉成簡體中文\n");

// 轉成繁體中文
echo $chinese->to(Chinese::CHT, "转成繁体中文\n");
```

## Switch library
Switch to OpenCC, run the following in command line
```sh
cd dict
git clone https://github.com/BYVoid/OpenCC.git
php import_opencc.php
```

Switch to WikiMedia, run the following in command line
```sh
cd dict
php import_wikimedia.php
```
