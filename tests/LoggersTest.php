<?php

declare(strict_types=1);

namespace Themosis\Components\Log\Tests;

use PHPUnit\Framework\Attributes\Test;
use Themosis\Components\Log\Channel;
use Themosis\Components\Log\Exceptions\LoggerAlreadyExists;
use Themosis\Components\Log\Exceptions\LoggerNotFound;
use Themosis\Components\Log\InMemoryLoggers;

final class LoggersTest extends TestCase {
	#[Test]
	public function it_can_store_and_retrieve_loggers_from_in_memory_repository(): void {
		$channel      = new Channel( 'app' );
		$dummy_logger = new DummyLogger();

		$loggers = new InMemoryLoggers();
		$loggers->add( $channel, $dummy_logger );

		$this->assertSame( $dummy_logger, $loggers->get( $channel ) );
	}

	#[Test]
	public function it_can_not_override_existing_loggers(): void {
		$channel      = new Channel( 'app' );
		$dummy_logger = new DummyLogger();

		$loggers = new InMemoryLoggers();
		$loggers->add( $channel, $dummy_logger );

		$other_channel      = new Channel( 'app' );
		$other_dummy_logger = new DummyLogger();

		$this->expectException( LoggerAlreadyExists::class );

		$loggers->add( $other_channel, $other_dummy_logger );
	}

	#[Test]
	public function it_can_throw_exception_when_accessing_unregistered_logger(): void {
		$loggers = new InMemoryLoggers();

		$channel = new Channel( 'not-registered' );

		$this->expectException( LoggerNotFound::class );

		$loggers->get( $channel );
	}
}
