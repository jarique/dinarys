<?php

namespace Test\CustomerVouchers\Setup\Patch\Data;

use Magento\Customer\Model\Group;
use Magento\Customer\Model\GroupFactory;
use Magento\Customer\Model\ResourceModel\Group as GroupResource;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Exception\AlreadyExistsException;

class CustomerGroupPatch implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var GroupFactory */
    private $groupFactory;

    /** @var GroupResource */
    private $groupResource;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        GroupFactory $groupFactory,
        GroupResource $groupResource
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->groupFactory = $groupFactory;
        $this->groupResource = $groupResource;
    }

    /**
     * @return DataPatchInterface|void
     * @throws AlreadyExistsException
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var Group $group */
        $group = $this->groupFactory->create();
        $group->setCode('Privileged Customers')->setTaxClassId(3);
        $this->groupResource->save($group);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public static function getVersion()
    {
        return '1.0.1';
    }
}
