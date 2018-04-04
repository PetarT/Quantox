<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.25
 */

namespace Quantox\Domain\Model\Base;

use Quantox\Domain\Model\BaseModel;

/**
 * Class User
 * @package Quantox\Domain\Model\Base
 */
class User extends BaseModel
{
    /**
     * Table name.
     *
     * @var  string
     */
    protected $table = 'users';
}
