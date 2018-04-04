<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 10.51
 */

namespace Quantox\Domain\Contracts\Repositories\Base;

use Quantox\Domain\Entities\Base\User;
use Quantox\Domain\Utilities\Arrays\Entities\Collection;

/**
 * Interface UserRepository
 *
 * User's Repository Contract.
 *
 * This <i>Contract</i> is meant to create a shared interface for <i>User</i>'s
 * <i>Repository</i> objects, in order to allow the Client to implement different
 * Strategies. <b>Strategy Pattern</b>.
 *
 * All <i>Repositories</i> should implement a dedicated <i>Contract</i>, in case we need
 * to change <i>Repositories</i> for a given context, without altering the <b>Domain's logic</b>.
 *
 * @package   Quantox\Domain\Contracts\Repositories\Base
 */
interface UserRepository
{
    /**
     * Retrieve a User's Entity by its record ID.
     *
     * This method should throw an Exception if the User for the given $id
     * was not found on the system.
     *
     * @param  int $id - Id to search for in the system.
     *
     * @return User
     */
    public function get(int $id): User;

    /**
     * Retrieve a User's Collection by search value.
     *
     * @param  string $search - Search value
     *
     * @return Collection
     */
    public function search(string $search): Collection;

    /**
     * Creates a new User record on the system, and returns the record's ID.
     *
     * If the record was not created, NULL will be returned.
     *
     * @param  User $user - New User Entity object.
     *
     * @return int|NULL
     */
    public function create(User $user): ?int;

    /**
     * Updates a User record on the system and returns true on success, false otherwise.
     *
     * @param  User $user - Existing User Entity object.
     *
     * @return bool
     */
    public function update(User $user): bool;

    /**
     * Deletes a record from the system, and returns the operation's success.
     *
     * @param  int $id - User's record ID.
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Method which tries to login the user.
     *
     * @param string $username
     * @param string $password
     *
     * @return User|null
     */
    public function login(string $username, string $password): User;
}
