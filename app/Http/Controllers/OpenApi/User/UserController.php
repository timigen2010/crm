<?php

namespace App\Http\Controllers\OpenApi\User;

use App\Http\Requests\User\RecoveryPasswordRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Model\User\Service\RecoveryPassword\RecoveryPasswordInterface;
use App\Model\User\Service\RecoveryPassword\RecoveryPasswordByConfirmToken\Data as RecoveryPasswordData;
use App\Model\User\Service\ResetPassword\ResetPasswordInterface;
use App\Model\User\Service\ResetPassword\ResetPasswordByEmail\Data as ResetPasswordData;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    private ResetPasswordInterface $resetPassword;

    private RecoveryPasswordInterface $recoveryPassword;

    public function __construct(ResetPasswordInterface $resetPassword,
                                RecoveryPasswordInterface $recoveryPassword)
    {
        $this->resetPassword = $resetPassword;
        $this->recoveryPassword = $recoveryPassword;
    }

    /**
     * @SWG\Post(
     *     path="api/users/reset_password",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ResetPasswordRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Reset password",
     *         @SWG\Schema(type="boolean")
     *      )
     * )
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPasswordAction(ResetPasswordRequest $request)
    {
        try {
            $this->resetPassword->reset(new ResetPasswordData(
                $request->request->get('email'),
                $request->request->get('redirectUrl')
            ));
            return new JsonResponse(true);
        } catch (\DomainException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @SWG\Post(
     *     path="api/users/recovery_password",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/RecoveryPasswordRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Reset password",
     *         @SWG\Schema(type="boolean")
     *      )
     * )
     * @param RecoveryPasswordRequest $request
     * @return JsonResponse
     */
    public function recoveryPasswordAction(RecoveryPasswordRequest $request)
    {
        try {
            $this->recoveryPassword->recovery(new RecoveryPasswordData(
                $request->request->get("confirmToken"),
                $request->request->get("password")
            ));
            return new JsonResponse(true);
        } catch (\DomainException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
