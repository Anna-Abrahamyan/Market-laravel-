<?php

namespace App\Services\User\Actions;



use App\Models\User;
use App\Repository\Read\User\UserReadRepositoryInterface;
use App\Repository\Write\User\UserWriteRepositoryInterface;
use App\Services\User\Dto\CreateUserDto;


class CreateUserAction {
    protected UserWriteRepositoryInterface $userWriteRepository;
    protected UserReadRepositoryInterface $userReadRepository;

    public function __construct(
        UserWriteRepositoryInterface $userWriteRepository,
        UserReadRepositoryInterface $userReadRepository,
    ) {
        $this->userWriteRepository = $userWriteRepository;
        $this->userReadRepository = $userReadRepository;
    }

    public function run(CreateUserDto $dto): User
    {
        $user = User::staticCreateUser($dto);
        $this->userWriteRepository->save($user);

        return $user;
    }
}
