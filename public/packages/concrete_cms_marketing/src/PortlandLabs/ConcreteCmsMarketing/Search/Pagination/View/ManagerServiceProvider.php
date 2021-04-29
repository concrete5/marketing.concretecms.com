<?php

/**
 * @project:   ConcreteCMS Marketing
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View;

use Concrete\Core\Foundation\Service\Provider as ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['manager/view/pagination'] = $this->app->share(function ($app) {
            return new Manager($app);
        });

        $this->app['manager/view/pagination/pager'] = $this->app->share(function ($app) {
            return new PagerManager($app);
        });
    }
}
