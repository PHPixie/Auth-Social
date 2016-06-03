<?php

namespace PHPixie\AuthSocial\Providers;

class OAuth extends \PHPixie\Auth\Providers\Provider\Implementation
{
    protected $socialProviders;

    public function __construct($socialProviders, $domain, $name, $configData)
    {
        parent::__construct($domain, $name, $configData);
        $this->socialProviders = $socialProviders;
    }

    public function loginUrl($providerName, $callbackUrl)
    {
        $provider = $this->socialProviders->get($providerName);
        return $provider->loginUrl($callbackUrl);
    }

    public function handleCallback($providerName, $callbackUrl, $data)
    {
        $provider = $this->socialProviders->get($providerName);
        $socialUser = $provider->handleCallback($callbackUrl, $data);

        if($socialUser === null) {
            return null;
        }

        $user = $this->repository()->getBySocialUser($socialUser);

        if($user !== null) {
            $this->setUser($user);
        }

        return $socialUser;
    }

    public function setUser($user)
    {
        $this->domain->setUser($user, $this->name);

        $persistProviders = $this->configData->get('persistProviders', array());
        foreach($persistProviders as $providerName) {
            $this->domain->provider($providerName)->persist();
        }
    }
}
