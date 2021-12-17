<?php

namespace App\Http\Middleware;

use App\Model\User\Entity\User;
use App\Model\User\Service\Permission\Get\GetPermissionInterface;
use App\Model\User\Service\Permission\Get\GetPermission\Data;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    private GetPermissionInterface $getPermission;

    public function __construct(GetPermissionInterface $getPermission)
    {
        $this->getPermission = $getPermission;
    }

    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();
        if (!$user) {
            return new JsonResponse('User is empty', Response::HTTP_FORBIDDEN);
        }
        if ($user->confirm_token) {
            return new JsonResponse('Account is not confirmed', Response::HTTP_FORBIDDEN);
        }
        $permission = $this->getPermission->getPermission(new Data(
            $request->route()->getName(),
            $user->userGroup->user_group_id)
        );
        if (!$permission) {
            return new JsonResponse('User has not permission', Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
