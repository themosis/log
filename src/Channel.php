<?php

declare(strict_types=1);

namespace Themosis\Components\Log;

use Stringable;

final class Channel implements Stringable {
	public function __construct(
		private string $name,
	) {
	}

	public function name(): string {
		return $this->name;
	}

	public function __toString(): string {
		return $this->name();
	}
}
