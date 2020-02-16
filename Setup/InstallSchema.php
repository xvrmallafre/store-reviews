<?php

namespace Xvrmallafre\StoreReviews\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

/**
 * Class InstallSchema
 *
 * @package Xvrmallafre\StoreReviews\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /**
     * InstallSchema constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup->startSetup();
        $reviewsTable = 'store_reviews';

        if (!$installer->tableExists($reviewsTable)) {
            $connection = $installer->getConnection();

            try {
                $table = $connection->newTable(
                    $installer->getTable($reviewsTable)
                )
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'increment_id',
                        Table::TYPE_TEXT,
                        50,
                        ['nullable' => false],
                        'Order increment_id'
                    )
                    ->addColumn(
                        'delivery',
                        Table::TYPE_INTEGER,
                        2,
                        ['nullable' => false],
                        'Valued delivery'
                    )
                    ->addColumn(
                        'product',
                        Table::TYPE_INTEGER,
                        2,
                        ['nullable' => false],
                        'Valued product'
                    )
                    ->addColumn(
                        'customer_support',
                        Table::TYPE_INTEGER,
                        2,
                        ['nullable' => false],
                        'Valued customer support'
                    )
                    ->addColumn(
                        'comment',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable' => true],
                        'Comment done by client'
                    )
                    ->addColumn(
                        'visible',
                        Table::TYPE_BOOLEAN,
                        1,
                        ['default' => true],
                        'Is review visible'
                    )
                    ->addColumn(
                        'visible',
                        Table::TYPE_BOOLEAN,
                        1,
                        ['default' => true],
                        'Is review visible'
                    )
                    ->addColumn(
                        'hash',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable' => false],
                        'Hash that allows the client to review the store'
                    )
                    ->addColumn(
                        'store_id',
                        Table::TYPE_INTEGER,
                        10,
                        ['nullable' => false],
                        'Store ID'
                    )
                    ->addColumn(
                        'is_msg_sent',
                        Table::TYPE_BOOLEAN,
                        1,
                        ['default' => false],
                        'Check when the email has been sent to the client'
                    )
                    ->addColumn(
                        'submited_at',
                        Table::TYPE_DATETIME,
                        255,
                        ['nullable' => true],
                        'Comment done by client'
                    )
                    ->addColumn(
                        'created_at',
                        Table::TYPE_DATETIME,
                        null,
                        ['default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')]
                    );
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable($reviewsTable),
                    $installer->getIdxName(
                        $installer->getTable($reviewsTable),
                        ['id'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['id'],
                    AdapterInterface::INDEX_TYPE_UNIQUE
                );
            } catch (\Exception $e) {
                $this->logger->error('InstallSchema Xvrmallafre_StoreReviews: ' . $e->getMessage());
            }
        }

        $installer->endSetup();
    }
}
