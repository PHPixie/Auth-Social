<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\AuthSocial
 */
class AuthSocialTest extends \PHPixie\Test\Testcase
{
    protected $social;
    
    protected $authSocial;
    
    public function setUp()
    {
        $this->social = $this->quickMock('\PHPixie\Social');
        $this->authSocial = new \PHPixie\AuthSocial($this->social);
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstructor()
    {
        
    }
    
    /**
     * @covers ::providers
     * @covers ::<protected>
     */
    public function testProviers()
    {
        $providers = $this->authSocial->providers();
        $this->assertInstance($providers, '\PHPixie\AuthSocial\Providers', array(
            'social' => $this->social
        ));
        
        $this->assertSame($providers, $this->authSocial->providers());
    }
}