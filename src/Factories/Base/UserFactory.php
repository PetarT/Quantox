<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 12.24
 */

namespace Quantox\Domain\Factories\Base;

use Quantox\Domain\Contracts\Repositories\Base\UserRepository;
use Quantox\Domain\Repositories\Database\Base\UserRepository as Repository;
use Quantox\Domain\Model\Base\User;

/**
 * User's Factory.
 *
 * @package   Quantox\Domain\Factories\Base
 */
class UserFactory
{
    /**
     * @var Repository $repository - User's Repository instance.
     */
    private static $repository = null;

    /**
     * Retrieves a new instance of a User's Repository class.
     *
     * @since  1.0.0
     * @return UserRepository
     */
    public static function createRepository(): UserRepository
    {
        return new Repository(
            new User()
        );
    }

    /**
     * Gets a Singleton instance of the User's Repository class.
     *
     * @return UserRepository
     */
    public static function getRepository(): UserRepository
    {
        // Validates if static instance has been created already.
        if (self::$repository == null) {
            self::$repository = self::createRepository();
        }

        // Returns instance.
        return self::$repository;
    }
}
