<?php

namespace PHPixie\AuthSocial;

class Providers extends \PHPixie\Auth\Providers\Builder\Implementation
{
    protected $social;

    public function __construct($social)
    {
        $this->social = $social;
    }

    public function buildOauthProvider($domain, $name, $configData)
    {
        return new Providers\OAuth(
            $this->social->providers(),
            $domain,
            $name,
            $configData
        );
    }

    public function name()
    {
        return 'social';
    }
}
