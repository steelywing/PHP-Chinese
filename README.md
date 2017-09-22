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

```php
use SteelyWing\Chinese\Chinese;

$chinese = new Chinese();

// 转成简体中文
echo $chinese->to('chs', "轉成簡體中文\n");

// 轉成繁體中文
echo $chinese->to('cht', "转成繁体中文\n");
```
