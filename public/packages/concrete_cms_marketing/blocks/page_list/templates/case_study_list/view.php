<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Entity\File\File;
use Concrete\Core\Entity\File\Version;
use Concrete\Core\Entity\Package;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\PageList;
use Concrete\Core\Search\Pagination\Pagination;
use Concrete\Core\Support\Facade\Application;
use Concrete\Package\ConcreteCmsMarketing\Controller;

/** @var string $pageListTitle */
/** @var PageList $list */
/** @var int $num */
/** @var Page[] $pages */
/** @var bool $showPagination */
/** @var string $pagination */

$app = Application::getFacadeApplication();
/** @var PackageService $packageService */
$packageService = $app->make(PackageService::class);
/** @var Package $pkgEntity */
$pkgEntity = $packageService->getByHandle("concrete_cms_marketing");
/** @var Controller $pkg */
$pkg = $pkgEntity->getController();

$defaultThumbnailUrl = $pkg->getRelativePath() . "/images/default-thumbnail.jpg";

?>
<div class="case-study-list-view">
    <div class="row">
        <div class="col">
            <h2 class="">
                <?php echo $pageListTitle; ?>
            </h2>
        </div>
    </div>

    <div class="row">
        <?php foreach ($pages as $page) { ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="case-study-item">
                    <?php
                    $thumbnailUrl = null;
                    $thumbnail = $page->getAttribute("thumbnail");

                    if ($thumbnail instanceof File) {
                        $thumbnailApprovedVersion = $thumbnail->getApprovedVersion();

                        if ($thumbnailApprovedVersion instanceof Version) {
                            $thumbnailUrl = $thumbnailApprovedVersion->getThumbnailURL("case_study_thumbnail");
                        }
                    }
                    ?>

                    <a href="<?php echo $page->getCollectionLink(); ?>" class="thumbnail">
                        <img src="<?php echo $thumbnailUrl ?? $defaultThumbnailUrl; ?>"
                             alt="<?php echo h($page->getCollectionName()); ?>">
                    </a>

                    <h3 class="title">
                        <a href="<?php echo $page->getCollectionLink(); ?>">
                            <?php echo $page->getCollectionName(); ?>
                        </a>
                    </h3>

                    <p class="description">
                        <?php echo $page->getCollectionDescription() ?? t("No Description available"); ?>
                    </p>

                    <div class="clearfix"></div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php if ($showPagination) { ?>
        <div class="container">
            <?php
            $list->setItemsPerPage($num);
            /** @var Pagination $pagination */
            $pagination = $list->getPagination();
            $pages = $pagination->getCurrentPageResults();
            echo $pagination->renderView("simple_pagination");
            ?>
        </div>
    <?php } ?>
</div>
