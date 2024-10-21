<?php

// SPDX-FileCopyrightText: 2024 Julien Lambé <julien@themosis.com>
//
// SPDX-License-Identifier: GPL-3.0-or-later

declare(strict_types=1);

namespace Themosis\Components\Log\Tests;

use PHPUnit\Framework\Attributes\Test;
use Themosis\Components\Log\Channel;
use Themosis\Components\Log\Exceptions\LoggerAlreadyExists;
use Themosis\Components\Log\Exceptions\LoggerNotFound;
use Themosis\Components\Log\InMemoryLoggers;

final class LoggersTest extends TestCase
{
    #[Test]
    public function it_can_store_and_retrieve_loggers_from_in_memory_repository(): void
    {
        $channel = new Channel('app');
        $dummyLogger = new DummyLogger();

        $loggers = new InMemoryLoggers();
        $loggers->add($channel, $dummyLogger);

        $this->assertSame($dummyLogger, $loggers->get($channel));
    }

    #[Test]
    public function it_can_not_override_existing_loggers(): void
    {
        $channel = new Channel('app');
        $dummyLogger = new DummyLogger();

        $loggers = new InMemoryLoggers();
        $loggers->add($channel, $dummyLogger);

        $otherChannel = new Channel('app');
        $otherDummyLogger = new DummyLogger();

        $this->expectException(LoggerAlreadyExists::class);

        $loggers->add($otherChannel, $otherDummyLogger);
    }

    #[Test]
    public function it_can_throw_exception_when_accessing_unregistered_logger(): void
    {
        $loggers = new InMemoryLoggers();

        $channel = new Channel('not-registered');

        $this->expectException(LoggerNotFound::class);

        $loggers->get($channel);
    }
}
