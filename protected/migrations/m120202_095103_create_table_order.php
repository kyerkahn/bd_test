<?php

class m120202_095103_create_table_order extends CDbMigration
{
	public function safeUp()
	{
    $this->createTable('{{order}}', array(
      'id' => 'pk',
      'name' => 'string NOT NULL',
    ));
	}

	public function safeDown()
	{
    $this->dropTable('{{order}}');
	}
}
