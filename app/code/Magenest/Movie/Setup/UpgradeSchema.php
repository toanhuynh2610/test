<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 21/03/2019
 * Time: 11:30
 */
namespace Magenest\Movie\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface {
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.9') < 0) {
            $installer = $setup;
            $installer->startSetup();
            /*CREATE MAGENEST_DIRECTOR*/
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director')
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true],
                'DirectorID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Name'
            )->setComment(
                'Custom Table'
            );
            $installer->getConnection()->createTable($table);
            /*CREATE MAGENEST_ACTOR*/
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true],
                'ActorID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Name'
            )->setComment(
                'Custom Table'
            );
            $installer->getConnection()->createTable($table);
            /*CREATE MAGENEST_MOVIE*/
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true],
                'MovieID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Name'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Description'
            )->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [],
                'Rating'
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => false],
                'DirectorID'
            )->addForeignKey(
                $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                'director_id',
                $installer->getTable('magenest_director'), /* main table name */
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment(
                'Cron Schedule'
            );
            $installer->getConnection()->createTable($table);
            /*CREATE MAGENEST_MOVIE_ACTOR*/

            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [ 'unsigned' => true,
                    'nullable' => false],
                'MovieID'
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [ 'unsigned' => true,
                    'nullable' => false],
                'ActorID'
            )->setComment(
                'Custom Table'
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'actor_id',
                $installer->getTable('magenest_actor'), /* main table name */
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'movie_id',
                $installer->getTable('magenest_movie'), /* main table name */
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
            $installer->getConnection()->createTable($table);

            $installer->endSetup();
        }
        if (version_compare($context->getVersion(), '2.1.0') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_rules')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true],
                'ID'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50,
                [],
                'Title'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                10,
                [],
                'Title'
            )->addColumn(
                'rule_type',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11, [],
                'Rule Type'
            )->addColumn(
                'condition_serialized',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Condition Serialized'
            )->setComment(
                'Custom Table'
            );
            $installer->getConnection()->createTable($table);

            $installer->endSetup();
        }
    }
}
