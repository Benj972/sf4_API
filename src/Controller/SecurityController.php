<?php

namespace App\Controller;

use App\Entity\Client;
use Swagger\Annotations as SWG;

class SecurityController
{
    /**
     * @SWG\Post(
     *     description="Authentication client and get access token",
     *     tags = {"Authentication"},
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *		   @SWG\Schema(
     *              type="array",
     *				@SWG\Items(
     *          		type="object",
     *              	@SWG\Property(property="token", type="string"),
     *          	),
     *          )
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Bad Request: Method Not Allowed",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: Bad credentials",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not Found: Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="Body",
     *          required= true,
     *          in="body",
     *          type="string",
     *          description="Use as login '_username: admin@example.com, _password: admintest' for test API",
     *          @SWG\Schema(
     *              type="array",
     *				@SWG\Items(
     *          		type="object",
     *              	@SWG\Property(property="_username", type="string"),
     *              	@SWG\Property(property="_password", type="string"),
     *          	),
     *          )
     *      )
     * )
     */
    public function login()
    {
        //manage by lexik_jwt_authentication
    }
}
