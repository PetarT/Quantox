<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 10.55
 */

namespace Quantox\Domain\Entities\Base;

use Quantox\Domain\Entities\BaseEntity;
use Quantox\Domain\Utilities\Datatypes\EmailAddress;

/**
 * Class User
 * @package Quantox\Domain\Entities\Base\User
 */
class User extends BaseEntity
{
    /**
     * User name.
     *
     * @var string
     */
    protected $name = '';

    /**
     * User username.
     *
     * @var string
     */
    protected $username = '';

    /**
     * User email address.
     *
     * @var EmailAddress
     */
    protected $email = null;

    /**
     * User password.
     *
     * @var string
     */
    protected $password = '';

    /**
     * {@inheritdoc}
     * @return bool
     */
    protected function validate(array $fields) : bool
    {
        return (
            parent::validate($fields) &&
            parent::validateIfAllFieldsExist(['name', 'username', 'email'], $fields)
        );
    }

    /**
     * Returns the Entity's name.
     *
     * @since  1.0.0
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the Entity's username.
     *
     * @since  1.0.0
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Returns the Entity's E-mail.
     *
     * @since  1.0.0
     * @return EmailAddress|NULL
     */
    public function getEmail(): ?EmailAddress
    {
        return $this->email;
    }
}
