[![Build Status](https://img.shields.io/travis/Fleshgrinder/php-constraint-violations.svg?style=flat-square)](https://travis-ci.org/Fleshgrinder/php-constraint-violations)
[![Code Climate](https://img.shields.io/codeclimate/github/Fleshgrinder/php-constraint-violations/badges/gpa.svg?style=flat-square)](https://codeclimate.com/github/Fleshgrinder/php-constraint-violations)
[![Test Coverage](https://img.shields.io/codeclimate/coverage/github/Fleshgrinder/php-constraint-violations.svg?style=flat-square)](https://codeclimate.com/github/Fleshgrinder/php-constraint-violations/coverage)
[![Packagist](https://img.shields.io/packagist/v/fleshgrinder/constraint-violations.svg?style=flat-square)](https://packagist.org/packages/fleshgrinder/constraint-violations)
[![Packagist License](https://img.shields.io/packagist/l/fleshgrinder/constraint-violations.svg?style=flat-square)](https://packagist.org/packages/fleshgrinder/constraint-violations)
[![VersionEye](https://img.shields.io/versioneye/d/user/projects/56f3002c35630e0034fd9d6b.svg?style=flat-square)](https://www.versioneye.com/user/projects/56f3002c35630e0034fd9d6b)
# PHP Constraint Violations
This library provides an implementation of the [Notification Pattern](http://martinfowler.com/eaaDev/Notification.html)
 with additional functionality to keep code DRY and to be more useful in the context of
 [Domain-Driven Design](http://www.domaindrivendesign.org/) (DDD) and its value objects.

## Installation
Open a terminal, enter your project directory and execute the following command to add this package to your
 dependencies:

```bash
$ composer require fleshgrinder/constraint-violations
```

This command requires you to have Composer installed globally, as explained in the
 [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

## Usage
Most basic usage is as illustrated in the following example:

```php
$input = 'some data';
$errors = new ViolationCollector();
$warnings = new ViolationCollector();

if (some_validation($input) === false) {
	$errors->addViolation('some message');
}

if (some_other_validation($input) === false) {
	$warnings->addViolation('some other message');
}

// More validations ...

if ($warnings->hasViolations) {
	echo "WARNINGS\n";
	foreach ($warnings->getMessages() as $message) {
		echo "{$message}\n";
	}
}

if ($errors->hasViolations) {
	echo "ERRORS\n";
	foreach ($warnings->getMessages() as $message) {
		echo "{$message}\n";
	}
	exit(1);
}

// Continue ...
```

Please have a look at the [wiki](https://github.com/fleshgrinder/php-constraint-violations/wiki) for more examples.

## Weblinks
- Martin Folwer: “_[Replacing Throwing Exceptions with Notification in Validations](http://martinfowler.com/articles/replaceThrowWithNotification.html)_”,
	in _martinfowler.com_, December 9, 2014.

## License
[![MIT License](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/License_icon-mit.svg/48px-License_icon-mit.svg.png)](https://opensource.org/licenses/MIT)
