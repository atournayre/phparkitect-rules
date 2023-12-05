<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Contracts;

use Arkitect\Expression\Expression;

interface RulesInterface
{
    public function that(): Expression;

    public function should(): Expression;

    public function because(): string;
}
