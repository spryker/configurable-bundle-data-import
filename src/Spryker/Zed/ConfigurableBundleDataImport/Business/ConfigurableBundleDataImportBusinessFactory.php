<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ConfigurableBundleDataImport\Business;

use Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep\ConfigurableBundleTemplateImageWriterStep;
use Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep\ConfigurableBundleTemplateKeyToIdConfigurableBundleTemplate;
use Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep\ConfigurableBundleTemplateSlotWriterStep;
use Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep\ConfigurableBundleTemplateWriterStep;
use Spryker\Zed\ConfigurableBundleDataImport\Business\ConfigurableBundleDataImportStep\ProductListKeyToIdProductList;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;

/**
 * @method \Spryker\Zed\ConfigurableBundleDataImport\ConfigurableBundleDataImportConfig getConfig()
 * @method \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerTransactionAware createTransactionAwareDataSetStepBroker($bulkSize = null)
 * @method \Spryker\Zed\DataImport\Business\Model\DataImporter getCsvDataImporterFromConfig(\Generated\Shared\Transfer\DataImporterConfigurationTransfer $dataImporterConfigurationTransfer)
 */
class ConfigurableBundleDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function getConfigurableBundleTemplateDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getConfigurableBundleTemplateDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createConfigurableBundleTemplateWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function getConfigurableBundleTemplateSlotDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getConfigurableBundleTemplateSlotDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createConfigurableBundleTemplateKeyToIdConfigurableBundleTemplateStep())
            ->addStep($this->createProductListKeyToIdProductListStep())
            ->addStep($this->createConfigurableBundleTemplateSlotWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function getConfigurableBundleTemplateImageDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getConfigurableBundleTemplateImageDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createConfigurableBundleTemplateKeyToIdConfigurableBundleTemplateStep())
            ->addStep($this->createConfigurableBundleTemplateImageWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createConfigurableBundleTemplateWriterStep(): DataImportStepInterface
    {
        return new ConfigurableBundleTemplateWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createConfigurableBundleTemplateSlotWriterStep(): DataImportStepInterface
    {
        return new ConfigurableBundleTemplateSlotWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createConfigurableBundleTemplateImageWriterStep(): DataImportStepInterface
    {
        return new ConfigurableBundleTemplateImageWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createConfigurableBundleTemplateKeyToIdConfigurableBundleTemplateStep(): DataImportStepInterface
    {
        return new ConfigurableBundleTemplateKeyToIdConfigurableBundleTemplate();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductListKeyToIdProductListStep(): DataImportStepInterface
    {
        return new ProductListKeyToIdProductList();
    }
}
