<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerTest\Zed\ConfigurableBundleDataImport;

use Codeception\Actor;
use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery;
use Orm\Zed\ProductImage\Persistence\Base\SpyProductImageQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery;

/**
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 * @method \Spryker\Zed\ConfigurableBundle\Business\ConfigurableBundleFacadeInterface getFacade()
 *
 * @SuppressWarnings(PHPMD)
 */
class ConfigurableBundleDataImportCommunicationTester extends Actor
{
    use _generated\ConfigurableBundleDataImportCommunicationTesterActions;

    public function ensureConfigurableBundleTablesIsEmpty(): void
    {
        $this->ensureDatabaseTableIsEmpty($this->getConfigurableBundleTemplateQuery());
        $this->ensureDatabaseTableIsEmpty($this->getConfigurableBundleTemplateSlotQuery());
    }

    public function ensureProductImageTablesIsEmpty(): void
    {
        $this->ensureDatabaseTableIsEmpty($this->getProductImageQuery());
        $this->ensureDatabaseTableIsEmpty($this->getProductImageSetQuery());
        $this->ensureDatabaseTableIsEmpty($this->getProductImageSetToProductImageQuery());
    }

    public function createConfigurableBundleTemplate(string $key): void
    {
        (new SpyConfigurableBundleTemplate())
            ->setKey($key)
            ->setName($key)
            ->save();
    }

    public function createProductList(string $key): void
    {
        $this->haveProductList([
            ProductListTransfer::TITLE => $key,
        ]);
    }

    protected function getConfigurableBundleTemplateQuery(): SpyConfigurableBundleTemplateQuery
    {
        return SpyConfigurableBundleTemplateQuery::create();
    }

    protected function getConfigurableBundleTemplateSlotQuery(): SpyConfigurableBundleTemplateSlotQuery
    {
        return SpyConfigurableBundleTemplateSlotQuery::create();
    }

    protected function getProductImageSetQuery(): SpyProductImageSetQuery
    {
        return SpyProductImageSetQuery::create();
    }

    protected function getProductImageSetToProductImageQuery(): SpyProductImageSetToProductImageQuery
    {
        return SpyProductImageSetToProductImageQuery::create();
    }

    /**
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageQuery
     */
    protected function getProductImageQuery(): SpyProductImageQuery
    {
        return SpyProductImageQuery::create();
    }
}
