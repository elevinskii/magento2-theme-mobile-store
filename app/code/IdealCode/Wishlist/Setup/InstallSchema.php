<?php
namespace IdealCode\Wishlist\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $installer, ModuleContextInterface $context)
    {
        $installer->startSetup();

        /**
         * Extend table 'wishlist'
         */
        $installer->getConnection()->addColumn(
            $installer->getTable('wishlist'),
            'visitor_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'unsigned' => true,
                'nullable' => false,
                'default' => '0',
                'comment' => 'Visitor ID'
            ]
        );

        $installer->getConnection()->changeColumn(
            $installer->getTable('wishlist'),
            'customer_id',
            'customer_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'unsigned' => true,
                'comment' => 'Customer ID'
            ]
        );

        $installer->endSetup();
    }
}
