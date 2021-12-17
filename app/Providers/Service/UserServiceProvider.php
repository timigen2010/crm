<?php

namespace App\Providers\Service;

use App\Console\Commands\User\RegisterUserCommand;
use App\EventListeners\User\AccessToken\AccessTokenCreateListener;
use App\Http\Controllers\Api\User\PermissionController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\OpenApi\User\UserController as OpenApiUserController;
use App\Http\Controllers\Api\User\UserGroupController;
use App\Http\Middleware\CheckPermission;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntity;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBEDial;
use App\Model\User\Serivce\DeleteUser\UserDelete;
use App\Model\User\Serivce\DeleteUser\UserDeleteInterface;
use App\Model\User\Serivce\Permission\Delete\PermissionDelete;
use App\Model\User\Serivce\Permission\Delete\PermissionDeleteInterface;
use App\Model\User\Serivce\UserGroup\Delete\UserGroupDelete;
use App\Model\User\Serivce\UserGroup\Delete\UserGroupDeleteInterface;
use App\Model\User\Service\ChangePassword\ChangePassword;
use App\Model\User\Service\ChangePassword\ChangePasswordInterface;
use App\Model\User\Service\EditUser\Avatar\EditAvatar;
use App\Model\User\Service\EditUser\Avatar\EditAvatarInterface;
use App\Model\User\Service\EditUser\EditUser;
use App\Model\User\Service\EditUser\EditUserAbstract;
use App\Model\User\Service\GeneratePassword\GeneratePasswordInterface;
use App\Model\User\Service\GeneratePassword\GeneratePasswordSha1;
use App\Model\User\Service\GetUsers\GetUsersByParams\GetUsers;
use App\Model\User\Service\GetUsers\GetUsersInterface;
use App\Model\User\Service\HistoryLogin\Factory\HistoryLoginFactory;
use App\Model\User\Service\HistoryLogin\Factory\HistoryLoginFactoryInterface;
use App\Model\User\Service\Permission\Factory\PermissionFactory;
use App\Model\User\Service\Permission\Factory\PermissionFactoryAbstract;
use App\Model\User\Service\Permission\Get\GetPermission\GetPermission;
use App\Model\User\Service\Permission\Get\GetPermissionInterface;
use App\Model\User\Service\Permission\Get\GetPermissions\GetPermissions;
use App\Model\User\Service\Permission\Get\GetPermissionsInterface;
use App\Model\User\Service\RecoveryPassword\RecoveryPasswordByConfirmToken\RecoveryPassword;
use App\Model\User\Service\RecoveryPassword\RecoveryPasswordInterface;
use App\Model\User\Service\RegisterUser\RegisterService\RegisterUser;
use App\Model\User\Service\RegisterUser\RegisterUserInterface;
use App\Model\User\Service\ResetPassword\ResetPasswordByEmail\ResetPassword;
use App\Model\User\Service\ResetPassword\ResetPasswordInterface;
use App\Model\User\Service\SipPhone\Find\FindSipPhone;
use App\Model\User\Service\SipPhone\Find\FindSipPhoneInterface;
use App\Model\User\Service\UserGroup\Factory\UserGroupFactory;
use App\Model\User\Service\UserGroup\Factory\UserGroupFactoryAbstract;
use App\Model\User\Service\UserGroup\Get\GetUserGroups\GetUserGroups;
use App\Model\User\Service\UserGroup\Get\GetUserGroupsInterface;
use App\Service\Phone\Clean\CleanPhone;
use App\Service\Phone\Clean\CleanPhoneInterface;
use App\Service\Phone\Clean\CleanPhoneService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(RegisterUserCommand::class)
            ->needs(RegisterUserInterface::class)
            ->give(RegisterUser::class);

        $this->app->when(RegisterUser::class)
            ->needs(GeneratePasswordInterface::class)
            ->give(GeneratePasswordSha1::class);

        $this->app->when(UserController::class)
            ->needs(RegisterUserInterface::class)
            ->give(RegisterUser::class);

        $this->app->when(UserController::class)
            ->needs(UserDeleteInterface::class)
            ->give(UserDelete::class);

        $this->app->when(UserController::class)
            ->needs(GetUsersInterface::class)
            ->give(GetUsers::class);

        $this->app->when(UserController::class)
            ->needs(EditUserAbstract::class)
            ->give(EditUser::class);

        $this->app->when(UserController::class)
            ->needs(ChangePasswordInterface::class)
            ->give(ChangePassword::class);

        $this->app->when(UserController::class)
            ->needs(EditAvatarInterface::class)
            ->give(EditAvatar::class);

        $this->app->when(OpenApiUserController::class)
            ->needs(ResetPasswordInterface::class)
            ->give(ResetPassword::class);

        $this->app->when(OpenApiUserController::class)
            ->needs(RecoveryPasswordInterface::class)
            ->give(RecoveryPassword::class);

        $this->app->when(RecoveryPassword::class)
            ->needs(GeneratePasswordInterface::class)
            ->give(GeneratePasswordSha1::class);

        $this->app->when(PermissionController::class)
            ->needs(PermissionFactoryAbstract::class)
            ->give(PermissionFactory::class);

        $this->app->when(PermissionController::class)
            ->needs(PermissionDeleteInterface::class)
            ->give(PermissionDelete::class);

        $this->app->when(PermissionController::class)
            ->needs(GetPermissionsInterface::class)
            ->give(GetPermissions::class);

        $this->app->when(UserGroupController::class)
            ->needs(UserGroupFactoryAbstract::class)
            ->give(UserGroupFactory::class);

        $this->app->when(UserGroupController::class)
            ->needs(UserGroupDeleteInterface::class)
            ->give(UserGroupDelete::class);

        $this->app->when(UserGroupController::class)
            ->needs(GetUserGroupsInterface::class)
            ->give(GetUserGroups::class);

        $this->app->when(CheckPermission::class)
            ->needs(GetPermissionInterface::class)
            ->give(GetPermission::class);

        $this->app->when(AccessTokenCreateListener::class)
            ->needs(HistoryLoginFactoryInterface::class)
            ->give(HistoryLoginFactory::class);

        $this->app->when(ChangePassword::class)
            ->needs(GeneratePasswordInterface::class)
            ->give(GeneratePasswordSha1::class);

        $this->app->when(EditUser::class)
            ->needs(GeneratePasswordInterface::class)
            ->give(GeneratePasswordSha1::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(FindSipPhoneInterface::class)
            ->give(FindSipPhone::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
