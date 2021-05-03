<?php

/**
 * @project:   ConcreteCMS Documentation
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Provider;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Entity\Package;
use Concrete\Core\Events\EventDispatcher;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;
use Concrete\Package\ConcreteCmsMarketing\Controller;

class ServiceProvider extends Provider
{

    /**
     * Registers the services provided by this provider.
     */
    public function register()
    {
        $al = AssetList::getInstance();
        $app = Application::getFacadeApplication();
        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $app->make(EventDispatcher::class);
        /** @var PackageService $packageService */
        $packageService = $app->make(PackageService::class);
        /** @var Package $pkgEntity */
        $pkgEntity = $packageService->getByHandle("concrete_cms_marketing");
        /** @var Controller $pkg */
        $pkg = $pkgEntity->getController();

        $al->register(
            'css', 'concrete-cms-marketing', 'css/concrete-cms-marketing.css',
            ['minify' => false, 'combine' => false], $pkg
        );

        $eventDispatcher->addListener('on_before_render', function () {
            View::getInstance()->requireAsset("css", "concrete-cms-marketing");
        });
    }
}