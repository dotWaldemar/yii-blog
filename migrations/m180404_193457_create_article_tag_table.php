<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m180404_193457_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);
        
        // Create index for column `article_id`
        $this->createIndex(
            'tag_article_article_id',
            'article_tag',
            'article_id'
        );

        // Add foreign key for table `article`
        $this->addForeignKey(
            'tag_article_article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        // Create index for column `tag_id`
        $this->createIndex(
            'idx_tag_id',
            'article_tag',
            'tag_id'
        );

        // Add foreign key for table `tag`
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_tag');
    }
}
