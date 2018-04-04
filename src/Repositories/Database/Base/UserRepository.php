<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 12.28
 */

namespace Quantox\Domain\Repositories\Database\Base;

use Quantox\Domain\Contracts\Repositories\Base\UserRepository as Contract;
use Quantox\Domain\Model\Base\User as UserModel;
use Quantox\Domain\Entities\Base\User;
use Quantox\Domain\Utilities\Arrays\Entities\Collection;
use Quantox\Domain\Exceptions\User\UserNotFoundException;

class UserRepository implements Contract
{
    /**
     * UserModel instance as ORM Model.
     *
     * @var  $model
     */
    protected $model = null;

    /**
     * Initializes an instance of the User's repository.
     *
     * @param  UserModel $model - ORM User's Model object.
     *
     * @return void
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve an User's Entity by its database record ID.
     *
     * @throws \InvalidArgumentException - If supplied ID is not a positive integer.
     * @throws UserNotFoundException     - If no User was found for the supplied ID.
     *
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::get()
     */
    public function get(int $id): User
    {
        // Validates provided $id.
        if (!\is_int($id) || $id < 1) {
            throw new \InvalidArgumentException("Supplied ID should be a positive integer.");
        }

        // Searches the database for the record.
        $user = $this->model->get($id);

        // Returns NULL if not found.
        if ($user == null) {
            throw new UserNotFoundException();
        }

        // Returns new User's Entity object.
        return (
            new User($user->getAttributes())
        );
    }

    /**
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::create()
     *
     * @return int
     */
    public function create(User $user): int
    {
        return $this->model->create($user->getAttributes());
    }

    /**
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::update()
     *
     * @return bool
     */
    public function update(User $user): bool
    {
        return $this->model->update($user->getAttributes());
    }

    /**
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::delete()
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    /**
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::search()
     *
     * @return Collection
     */
    public function search(string $search): Collection
    {
        $users      = $this->model->filter(array('name' => $search, 'username' => $search, 'email' => $search));
        $collection = new Collection();

        foreach ($users as $user) {
            $collection->add(new User($user));
        }

        return $collection;
    }

    /**
     * {@inheritDoc}
     * @see \Quantox\Domain\Contracts\Repositories\Base\UserRepository::login()
     *
     * @return  User|null
     */
    public function login(string $username, string $password) : User
    {
        $filter = $this->model->filter(array('username' => $username, 'password' => $password), true);

        if (!empty($filter)) {
            $user = new User($filter[0]);
        } else {
            return null;
        }

        return $user;
    }
}
