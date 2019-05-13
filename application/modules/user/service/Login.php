<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\User\Service;

use Modules\User\Mappers\User as UserMapper;
use Modules\User\Service\Login\Result as LoginResult;

/**
 * Klasse für einheitliches Login Handling
 */
class Login
{
    /** @var UserMapper */
    private $mapper;

    /** @var Password */
    private $passwordService;

    /**
     * Simple factory for more convenient usage
     * @return static
     */
    public static function factory()
    {
        return new static(new UserMapper(), new Password());
    }

    /**
     * Login constructor.
     * @param UserMapper $mapper
     * @param Password $passwordService
     */
    public function __construct(UserMapper $mapper, Password $passwordService)
    {
        $this->mapper = $mapper;
        $this->passwordService = $passwordService;
    }

    /**
     * Performs the Login for a User
     * @param string $userNameOrEmail
     * @param string $password
     * @return LoginResult
     * @throws \Ilch\Database\Exception
     */
    public function perform($userNameOrEmail, $password)
    {
        $user = $this->mapper->getUserByEmail($userNameOrEmail);

        if ($user == null) {
            $user = $this->mapper->getUserByName($userNameOrEmail);
        }

        if ($user == null || !$this->passwordService->verify($password, $user->getPassword())) {
            return new LoginResult(false, $user, LoginResult::LOGIN_FAILED);
        } elseif (!$user->getConfirmed()) {
            return new LoginResult(false, $user, LoginResult::USER_NOT_ACTIVATED);
        } elseif ($user->getLocked()) {
            return new LoginResult(false, $user, LoginResult::USER_LOCKED);
        } elseif ($user->getSelectsDelete() != '' AND $user->getSelectsDelete() != '0000-00-00 00:00:00') {
            $this->mapper->selectsdelete($user->getId());
            $_SESSION['user_id'] = $user->getId();
            return new LoginResult(true, $user, LoginResult::USER_SELECTSDELETE);
        }

        $_SESSION['user_id'] = $user->getId();

        return new LoginResult(true, $user);
    }
}
