<?php

namespace PHPixie\AuthSocial\Providers;

class OAuth extends \PHPixie\Auth\Providers\Provider\Implementation
{
    protected $socialProvider;
    
    public function __construct($socialProviders, $domain, $name, $configData)
    {
        parent::__construct($domain, $name, $configData);
        $this->social = $social;
    }
    
    public function loginUrl($providerName, $callbackUrl)
    {
        $provider = $this->socialProviders->get($providerName);
        return $provider->provider->loginUrl($callbackUrl);
    }
    
    public function handleResponse($providerName, $data, $callbackUrl)
    {
        $provider = $this->socialProviders->get($providerName);
        $socialUser = $provider->handleCallback($data, $callbackUrl);
        $user = $this->repository()->getBySocialUser($socialUser);
        
        if($user === null) {
            return null;
        }
        
        $this->domain->setUser($user, $this->name);
        
        $persistProviders = $this->configData->get('persistProviders', array());
        foreach($persistProviders as $providerName) {
            $this->domain->provider($providerName)->persist();
        }
        
        return $socialUser;
    }
}