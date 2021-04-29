<?php

/**
 * @project:   ConcreteCMS Marketing
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View;

use Concrete\Core\Search\Pagination\View\PagerManager as CorePagerManager;

class PagerManager extends CorePagerManager
{
    protected function createSimplePaginationDriver()
    {
        return new SimplePaginationPagerView();
    }
}