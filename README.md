<!--
SPDX-FileCopyrightText: 2024 Julien Lambé <julien@themosis.com>

SPDX-License-Identifier: GPL-3.0-or-later
-->

Themosis Log
============

The Themosis log component is a lightweight logging library for PHP.

The component is only promoting the PSR-3 interface and provides a simple repository interface and concrete
in-memory implementation to manage PSR-3 compatible loggers.

By default, the library is not installing any logger implementation but is suggesting the usage of the
popular [Monolog](https://seldaek.github.io/monolog/) package.

Feel free to install any PSR-3 compatible logger alongside the library.

Installation
------------

> Examples below are leveraging the usage of the [Monolog](https://seldaek.github.io/monolog/) library.

Install the package using [Composer](https://getcomposer.org/) and add you preferred logging library implementation:

```shell
composer require themosis/log monolog/monolog
```

The above code is going to install the `themosis/log` package as well as the `monolog/monolog` one.

Usage
-----

### Register a logger

You can register a logger using the in-memory repository. Each **logger** must have a unique channel name.

```php
use Themosis\Components\Log\Channel;
use Themosis\Components\Log\InMemoryLoggers;

// Create a logger instance using any PSR-3 library
$channel = new Channel('APP');
$logger = new Monolog\Logger($channel);

// Register the logger in the registry
$loggers = new InMemoryLoggers();
$loggers->add($channel, $logger);
```

The channel class provided a unique identifier for the associated logger.

> A logger can not be overwritten in the repository and will throw a `LoggerAlreadyExists` exception if you try to do so.

### Retrieve a logger

You can get back a registered logger by passing the channel identifier like so:

```php
$applicationLogger = $loggers->get(new Channel('APP'));

// Log something using the PSR-3 retrieved logger...
$applicationLogger->info('An applicaton event just occured...');
```

> The repository will throw a `LoggerNotFound` exception if the logger is not registered and you're trying to retrieve it.

If you intend to always expect a logger to be returned from the repository even if not registered, you can 
simply create your own repository by using the `Themosis\Components\Log\Loggers` interface.
