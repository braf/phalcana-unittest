# Phalcana Unit Testing Module

This is a Unit testing module for Phalcana. This does not actually contain any of the tests, 
the tests are defined in the tests folder for each module and in the core.

## Installation

This module is installed by default with the Phalcana project by composer for more 
information see the [Phalcana Project](http://github.com/braf/phalcana-unittest)

## Running Tests

The unit tests can be run by using the one of following commands from the project root directory.

Using the binary that comes from installing via composer.

```bash
vendor/phpunit/phpunit/phpunit --bootstrap modules/unittest/index.php modules/unittest/tests.php
```

With php unit installed globally on your system.

```bash
phpunit --bootstrap modules/unittest/index.php modules/unittest/tests.php
```

## Writing tests

Tests are stored in the appropriate module in a folder called `tests` and should extend be the
in the namespace `Phalcana\Tests` and should extend the class `Phalcana\Unittests\TestCase`.

Please find below an example unit test header.

```php
<?php

namespace Phalcana\Tests;

use Phalcana\Unittest\TestCase;

/**
 * Example test name
 *
 * @group phalana
 * @group phalana.core
 * @group phalana.core.arr
 *
 * @package    Phalcana
 * @category   Tests
 */
class ExampleTest extends TestCase
{

}
```
