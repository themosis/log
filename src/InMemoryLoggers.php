<?php

// SPDX-FileCopyrightText: 2024 Julien Lambé <julien@themosis.com>
//
// SPDX-License-Identifier: GPL-3.0-or-later

declare(strict_types=1);

namespace Themosis\Components\Log;

use Psr\Log\LoggerInterface;
use Themosis\Components\Log\Exceptions\LoggerAlreadyExists;
use Themosis\Components\Log\Exceptions\LoggerNotFound;

final class InMemoryLoggers implements Loggers
{
    private array $loggers = [];

    public function add(Channel $channel, LoggerInterface $logger): void
    {
        if (isset($this->loggers[ (string) $channel ])) {
            throw new LoggerAlreadyExists(
                message: sprintf('A logger instance is already declared for channel "%s"', (string) $channel),
            );
        }

        $this->loggers[ (string) $channel ] = $logger;
    }

    public function get(Channel $channel): LoggerInterface
    {
        if (! isset($this->loggers[ (string) $channel ])) {
            throw new LoggerNotFound(
                message: sprintf('No logger instance declared for channel "%s"', (string) $channel),
            );
        }

        return $this->loggers[ (string) $channel ];
    }
}
