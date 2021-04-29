<?php

namespace Concrete\Package\ConcreteCmsMarketing;

use Concrete\Core\Package\Package;
use PortlandLabs\ConcreteCmsMarketing\Provider\ServiceProvider;

class Controller extends Package
{

    protected $pkgHandle = 'concrete_cms_marketing';
    protected $appVersionRequired = '9.0.0a1';
    protected $pkgVersion = '0.81.2';
    protected $pkgAutoloaderMapCoreExtensions = true;
    protected $pkgAutoloaderRegistries = array(
        'src/PortlandLabs/ConcreteCmsMarketing' => 'PortlandLabs\ConcreteCmsMarketing'
    );

    public function getPackageDescription()
    {
        return t("The marketing.concretecms.com extensions.");
    }

    public function getPackageName()
    {
        return t("marketing.concretecms.com");
    }

    public function on_start()
    {
        /** @var ServiceProvider $serviceProvider */
        $serviceProvider = $this->app->make(ServiceProvider::class);
        $serviceProvider->register();
    }
    
    public function install()
    {
        parent::install();
        $this->installContentFile('data.xml');
        $this->installContentFile('content.xml');
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installContentFile('data.xml');
    }
}
