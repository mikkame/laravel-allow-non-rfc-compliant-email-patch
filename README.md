# Allow non rfc complaint email validator

[![Build Status](https://travis-ci.org/tecpresso/laravel-allow-non-rfc-compliant-email-patch.svg?branch=master)](https://travis-ci.org/tecpresso/laravel-allow-non-rfc-compliant-email-patch)
[![Latest Stable Version](https://poser.pugx.org/tecpresso/laravel-allow-non-rfc-compliant-email-patch/version)](https://packagist.org/packages/tecpresso/laravel-allow-non-rfc-compliant-email-patch)
[![Total Downloads](https://poser.pugx.org/tecpresso/laravel-allow-non-rfc-compliant-email-patch/downloads)](https://packagist.org/packages/tecpresso/laravel-allow-non-rfc-compliant-email-patch)
[![License](https://poser.pugx.org/tecpresso/laravel-allow-non-rfc-compliant-email-patch/license)](https://packagist.org/packages/tecpresso/laravel-allow-non-rfc-compliant-email-patch)

Make RFC violation email address sendable.

<span style="color: red; ">This library suppresses Laravel exceptions. There are cases where it cannot be sent depending on the setting of the your mail server</span>
<span style="color: red; ">このライブラリはLaravelの例外を抑制するものです。メールサーバの設定によりメールが送信できない可能性があります</span>

For example:

```
.not-rfc@example.com
not-rfc.@example.com
not..rfc@example.com

```


## Install

```bash
composer require tecpresso/laravel-allow-non-rfc-compliant-email-patch
```

This library corresponds to auto discovery

If you using laravel 5.4. you have to add the provider in the providers array (config/app.php)



## Usage

The library enabled automatically.


## Testing

```bash
composer test
```

## Lisence

MIT
