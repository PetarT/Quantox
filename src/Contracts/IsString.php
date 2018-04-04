<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.54
 */

namespace Quantox\Domain\Contracts;

/**
 * Is String interface.
 *
 * This interface is used to identify objects that can be converted into strings.
 *
 * @package Quantox\Domain\Contracts
 */
interface IsString
{
    /**
     * Returns the String representation of the object.
     *
     * @return string
     */
    public function __toString(): string;
}
