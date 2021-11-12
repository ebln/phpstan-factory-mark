<?php

declare(strict_types=1);

namespace Ebln\PHPStan\EnforceFactory;

/**
 * Marks classes to be instanciated by certain factories
 */
interface ForceFactoryInterface
{
    /**
     * Defines classes allowed to instanciate the interface-implementor
     *
     * @return string[] List of FQCNs
     * @phpstan-return class-string[]
     */
    public static function getFactories(): array;
}
