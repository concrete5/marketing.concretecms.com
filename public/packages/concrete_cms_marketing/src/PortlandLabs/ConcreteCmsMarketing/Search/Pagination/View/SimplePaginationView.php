<?php

/**
 * @project:   ConcreteCMS Marketing
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsMarketing\Search\Pagination\View;

use Concrete\Core\Search\Pagination\View\ConcreteBootstrap4View;

class SimplePaginationView extends ConcreteBootstrap4View
{
    protected function createDefaultTemplate()
    {
        return new SimplePaginationTemplate();
    }

}
