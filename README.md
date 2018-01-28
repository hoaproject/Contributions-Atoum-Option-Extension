<p align="center">
	<img src="https://static.hoa-project.net/Image/Hoa.svg" alt="Hoa" width="250px" />
</p>

---

<p align="center">
	<a href="https://travis-ci.org/hoaproject/atoum-option-extension"><img src="https://img.shields.io/travis/hoaproject/atoum-option-extension/master.svg" alt="Build status" /></a>
	<a href="https://coveralls.io/github/hoaproject/atoum-option-extension?branch=master"><img src="https://img.shields.io/coveralls/hoaproject/atoum-option-extension/master.svg" alt="Code coverage" /></a>
	<a href="https://packagist.org/packages/hoa/atoum-option-extension"><img src="https://img.shields.io/packagist/dt/hoa/atoum-option-extension.svg" alt="Packagist" /></a>
	<a href="https://hoa-project.net/LICENSE"><img src="https://img.shields.io/packagist/l/hoa/atoum-option-extension.svg" alt="License" /></a>
</p>
<p align="center">
	Hoa is a <strong>modular</strong>, <strong>extensible</strong> and
	<strong>structured</strong> set of PHP libraries.<br />
	Moreover, Hoa aims at being a bridge between industrial and research worlds.
</p>

# Hoa\atoum-option-extension

[![Help on IRC](https://img.shields.io/badge/help-%23hoaproject-ff0066.svg)](https://webchat.freenode.net/?channels=#hoaproject)
[![Help on Gitter](https://img.shields.io/badge/help-gitter-ff0066.svg)](https://gitter.im/hoaproject/central)
[![Documentation](https://img.shields.io/badge/documentation-hack_book-ff0066.svg)](https://central.hoa-project.net/Documentation/Library/atoum-option-extension)
[![Board](https://img.shields.io/badge/organisation-board-ff0066.svg)](https://waffle.io/hoaproject/atoum-option-extension)

This tools is an extension for [atoum](http://atoum.org) to help you creating your unit test for a project using [hoa/Option](https://central.hoa-project.net/Documentation/Library/Option)

## Installation

With [Composer](https://getcomposer.org/), to include this library into
your dependencies, you need to
require [`hoa/atoum-option-extension`](https://packagist.org/packages/hoa/atoum-option-extension):

```sh
$ composer require hoa/atoum-option-extension
```

For more installation procedures, please read [the Source page](https://hoa-project.net/Source.html).

## Testing

Before running the test suites, the development dependencies must be installed:

```sh
$ composer install
```

Then, to run all the test suites:

```sh
$ vendor/bin/atoum
```

For more information, please read the [contributor guide](https://hoa-project.net/Literature/Contributor/Guide.html).

## Quick usage

```php
<?php

$this->given($this->newTestedInstance)
	->hoaOption($this->testedInstance->doSomethingReturningAnOption())
		->isNone;
$this->given($this->newTestedInstance)
	->hoaOption($this->testedInstance->doSomethingReturningAnOption())
		->isSome('This should be a value');
$this->given($this->newTestedInstance)
	->hoaOption($this->testedInstance->wrapTheGivenValueInAnOption(42))
		->some()
		->integer($this->getValue())->isEqualTo(42);
```

### New assertion defined

* hoaOption: validated that the given value is an Option instance
  * isSome('custom failed message') or isSome: validated that the Option contains a value
  * isNone('custom failed message') or isNone: validated that the Option doesn't contains a value
  * some() or some: allow you to get the unwrapped value to chain on, validated that the value is in the option first

## Documentation

The [hack book of `Hoa\atoum-option-extension`](https://central.hoa-project.net/Documentation/Library/atoum-option-extension) contains
detailed information about how to use this library and how it works.

More documentation can be found on the project's website:
[hoa-project.net](https://hoa-project.net/).

## Getting help

There are mainly two ways to get help:

* On the [`#hoaproject`](https://webchat.freenode.net/?channels=#hoaproject) IRC channel,
* On the forum at [users.hoa-project.net](https://users.hoa-project.net).

## Contribution

Do you want to contribute? Thanks! A detailed [contributor guide](https://hoa-project.net/Literature/Contributor/Guide.html) explains
everything you need to know.

## License

Hoa is under the New BSD License (BSD-3-Clause). Please, see
[`LICENSE`](https://hoa-project.net/LICENSE) for details.
