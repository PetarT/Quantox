<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.53
 */

namespace Quantox\Domain\Utilities\Datatypes;

use Quantox\Domain\Contracts\IsString;

/**
 * E-mail address utility class.
 *
 * Utility class to hold and validate a single E-mail address value, as
 * an E-mail address is a complex field, with a very specific set of rules.
 *
 * @package   Quantox\Domain\Utilities\Datatypes
 */
class EmailAddress implements IsString
{
    /**
     * Holds the Username's part of the E-mail address.
     *
     * @var string
     */
    private $username = null;

    /**
     * Holds the Domain part of the E-mail address.
     *
     * @var string
     */
    private $domain = null;

    /**
     * Holds the Top Level Domain part of the E-mail address.
     *
     * @var string $tld
     */
    private $tld = null;

    /**
     * Initializes a new instance of an E-mail address.
     *
     * @param  string $email - String representation of the e-mail address.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     *
     * @since  1.0.0
     * @return void
     */
    public function __construct(string $email)
    {
        // Loads data into class.
        $this->loadEmail($email);
    }

    /**
     * Loads supplied $email address string representation into the class.
     *
     * @param  string $email - String representation of the e-mail.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     *
     * @since  1.0.0
     * @return void
     */
    private function loadEmail(string $email): void
    {
        // Validate supplied parameter.
        if (!\is_string($email) || \strlen(\trim($email)) == 0) {
            throw new \InvalidArgumentException("Supplied e-mail address must be a non empty string.");
        }

        if (!\filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Provided e-mail field does not seam to be a valid e-mail address.");
        }

        // Sanitizes and processes supplied e-mail address.
        $email          = \strtolower(\trim($email));
        $parts          = \explode('@', $email);
        $this->username = $parts[0];

        // Processes the right side of the e-mail address.
        $domain       = \explode('.', $parts[1]);
        $this->tld    = \array_pop($domain);
        $this->domain = \implode('.', $domain);
    }

    /**
     * Returns the String representation of the object.
     *
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\IsString::toString()
     */
    public function __toString(): string
    {
        return $this->getAddress();
    }

    /**
     * Returns a string representation for the Email address.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return ($this->username . '@' . $this->domain . '.' . $this->tld);
    }

    /**
     * Return the Username part for the e-mail address.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Return the Domain part for the e-mail address.
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Return the Top Level Domain part for the e-mail address.
     *
     * @return string
     */
    public function getTopLevelDomain(): string
    {
        return $this->tld;
    }
}
