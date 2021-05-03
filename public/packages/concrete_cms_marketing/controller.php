<?php

namespace Concrete\Package\ConcreteCmsMarketing;

use Concrete\Core\Package\Package;
use Concrete\Core\Page\PageList;
use Concrete\Core\Page\Summary\Template\Populator;
use PortlandLabs\ConcreteCmsMarketing\Provider\ServiceProvider;

class Controller extends Package
{

    protected $pkgHandle = 'concrete_cms_marketing';
    protected $appVersionRequired = '9.0.0a1';
    protected $pkgVersion = '0.81.4';
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

    private function postInstall()
    {
        /*
         * This is required to update the available page templates
         */
        /** @var Populator $populator */
        $populator = $this->app->make(Populator::class);
        /** @var PageList $pageList */
        $pageList = $this->app->make(PageList::class);
        foreach ($pageList->getResults() as $page) {
            $populator->updateAvailableSummaryTemplates($page);
        }
    }

    public function install()
    {
        parent::install();
        $this->installContentFile('data.xml');
        $this->installContentFile('content.xml');
        $this->postInstall();
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installContentFile('data.xml');
        $this->postInstall();
    }
}
