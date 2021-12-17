<?php

namespace App\Http\Annotations;

/**
 * @SWG\Post(
 *      path="/oauth/token",
 *      summary="Requests a refresh token",
 *      tags={"OAuth"},
 *      operationId="refreshToken",
 *      @SWG\Parameter(
 *          name="grant_type",
 *          in="formData",
 *          description="refresh_token or password",
 *          required=true,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="client_id",
 *          in="formData",
 *          description="OAuth Client ID",
 *          required=true,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="client_secret",
 *          in="formData",
 *          description="OAuth Client Secret",
 *          required=true,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="scope",
 *          in="query",
 *          description="What scopes are requested, for all, use '*'",
 *          required=true,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="refresh_token",
 *          in="formData",
 *          description="Refresh_token from the authorization response",
 *          required=false,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="username",
 *          in="formData",
 *          description="Username for login",
 *          required=false,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="password",
 *          in="formData",
 *          description="Password for the user",
 *          required=false,
 *          type="string"
 *      ),
 *      @SWG\Response(
 *          response=200,
 *          description="successful operation",
 *      )
 * )
 */
