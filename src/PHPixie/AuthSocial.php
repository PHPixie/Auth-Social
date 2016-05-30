<?php

namespace PHPixie;

class AuthSocial
{
    protected $social;
    
    protected $providers;
    
    public function __construct($social)
    {
        $this->social = $social;
    }
    
    public function providers()
    {
        if($this->providers === null) {
            $this->providers = new AuthSocial\Providers($this->social);
        }
        
        return $this->providers;
    }
}