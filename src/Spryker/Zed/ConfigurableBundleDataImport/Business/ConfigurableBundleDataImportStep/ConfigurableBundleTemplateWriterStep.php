<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep;

use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery;
use Spryker\Zed\ConfigurableBundle\Dependency\ConfigurableBundleEvents;
use Spryker\Zed\ConfigurableBundleDataImport\Business\DataSet\ConfigurableBundleTemplateDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ConfigurableBundleTemplateWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $configurableBundleTemplateEntity = $this->createConfigurableBundleTemplateQuery()
            ->filterByKey($dataSet[ConfigurableBundleTemplateDataSetInterface::COLUMN_CONFIGURABLE_BUNDLE_TEMPLATE_KEY])
            ->findOneOrCreate();

        $configurableBundleTemplateEntity
            ->setUuid($dataSet[ConfigurableBundleTemplateDataSetInterface::COLUMN_CONFIGURABLE_BUNDLE_TEMPLATE_UUID] ?: null)
            ->setName($dataSet[ConfigurableBundleTemplateDataSetInterface::COLUMN_CONFIGURABLE_BUNDLE_TEMPLATE_NAME])
            ->setIsActive($dataSet[ConfigurableBundleTemplateDataSetInterface::COLUMN_CONFIGURABLE_BUNDLE_TEMPLATE_IS_ACTIVE])
            ->save();

        $this->addPublishEvents(
            ConfigurableBundleEvents::CONFIGURABLE_BUNDLE_TEMPLATE_PUBLISH,
            $configurableBundleTemplateEntity->getIdConfigurableBundleTemplate(),
        );
    }

    /**
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery
     */
    protected function createConfigurableBundleTemplateQuery(): SpyConfigurableBundleTemplateQuery
    {
        return SpyConfigurableBundleTemplateQuery::create();
    }
}
