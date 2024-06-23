<?php

// SPDX-FileCopyrightText: 2024 Julien Lambé <julien@themosis.com>
//
// SPDX-License-Identifier: GPL-3.0-or-later

declare(strict_types=1);

namespace Themosis\Components\Log\Tests;

use Psr\Log\LoggerInterface;
use Stringable;

final class DummyLogger implements LoggerInterface {
	public function emergency( string|Stringable $message, array $context = [] ): void { }

	public function alert( string|Stringable $message, array $context = [] ): void { }

	public function critical( string|Stringable $message, array $context = [] ): void { }

	public function error( string|Stringable $message, array $context = [] ): void { }

	public function warning( string|Stringable $message, array $context = [] ): void { }

	public function notice( string|Stringable $message, array $context = [] ): void { }

	public function info( string|Stringable $message, array $context = [] ): void { }

	public function debug( string|Stringable $message, array $context = [] ): void { }

	public function log( $level, string|Stringable $message, array $context = [] ): void { }
}
