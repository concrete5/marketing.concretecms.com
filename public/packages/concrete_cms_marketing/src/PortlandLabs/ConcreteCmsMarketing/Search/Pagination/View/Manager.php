<?php

/**
 * @project:   ConcreteCMS Marketing
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View;

use Concrete\Core\Search\Pagination\View\Manager as CoreManager;

class Manager extends CoreManager
{
    protected function createSimplePaginationDriver()
    {
        return new SimplePaginationView();
    }
}