<?php

namespace PHPixie\SocialLogin;

interface Repository extends \PHPixie\Auth\Repositories\Repository
{
    public function getBySocialUser($providerName, $login);
}