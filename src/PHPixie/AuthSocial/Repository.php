<?php

namespace PHPixie\AuthSocial;

interface Repository extends \PHPixie\Auth\Repositories\Repository
{
    public function getBySocialUser($socialUser);
}
