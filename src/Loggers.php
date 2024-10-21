<?php

// SPDX-FileCopyrightText: 2024 Julien Lambé <julien@themosis.com>
//
// SPDX-License-Identifier: GPL-3.0-or-later

declare(strict_types=1);

namespace Themosis\Components\Log;

use Psr\Log\LoggerInterface;

interface Loggers
{
    public function add(Channel $channel, LoggerInterface $logger): void;

    public function get(Channel $channel): LoggerInterface;
}
