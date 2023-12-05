<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Contracts;

use Arkitect\Expression\Expression;

interface AndThatInterface
{
    /**
     * @return array|Expression[]
     */
    public function andThat(): array;
}
