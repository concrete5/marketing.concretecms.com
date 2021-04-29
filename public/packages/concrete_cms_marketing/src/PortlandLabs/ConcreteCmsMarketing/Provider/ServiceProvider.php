<?php

/**
 * @project:   ConcreteCMS Marketing
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Provider;

use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Search\Pagination\View\ManagerServiceProvider as CorePaginationManager;
use PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View\Manager;
use PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View\ManagerServiceProvider as PaginationManager;
use PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View\PagerManager;

class ServiceProvider extends Provider
{

    public function register()
    {
        $this->app['manager/view/pagination'] = $this->app->share(function ($app) {
            return new Manager($app);
        });

        $this->app['manager/view/pagination/pager'] = $this->app->share(function ($app) {
            return new PagerManager($app);
        });

        $this->app->bind(CorePaginationManager::class, PaginationManager::class);
    }

}