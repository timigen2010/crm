<?php

namespace App\Model\User\Service\ResetPassword\ResetPasswordByEmail;

use App\Model\User\Repository\User\UserRepository;
use App\Model\User\Service\Event\PasswordReset;
use App\Model\User\Service\ResetPassword\ResetPasswordInterface;
use Illuminate\Contracts\Events\Dispatcher;

class ResetPassword implements ResetPasswordInterface
{
    private UserRepository $userRepository;

    private Dispatcher $dispatcher;

    public function __construct(UserRepository $userRepository, Dispatcher $dispatcher)
    {
        $this->userRepository = $userRepository;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Data $data
     * @throws \Throwable
     */
    public function reset($data)
    {
        $user = $this->userRepository->findByEmail($data->email);
        if (empty($user)) {
            throw new \DomainException("Email not found");
        }
        $user->password = '';
        $user->salt = '';
        $user->confirm_token = trim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $user->saveOrFail();
        $this->dispatcher->dispatch(new PasswordReset($user, $data->urlRedirect));
    }
}
