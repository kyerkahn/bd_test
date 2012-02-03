<?php

class m120202_095103_create_table_order extends CDbMigration
{
	public function safeUp()
	{
    $this->createTable('{{contractor}}', array(
      'id' => 'pk',
      'name' => 'varchar(50) NOT NULL',
      'surname' => 'varchar(50) NOT NULL DEFAULT ""',
    )/*, 'ENGINE = InnoDB'*/);

    //$this->createIndex('name_index', '{{contractor}}', 'name');
    //$this->createIndex('surname_index', '{{contractor}}', 'surname');

    $this->createTable('{{order}}', array(
      'id' => 'pk',
      'name' => 'string NOT NULL',
      'contractor_id' => 'integer NOT NULL',
    )/*, 'ENGINE = InnoDB'*/);
    //$this->addForeignKey('contractor', '{{order}}', 'contractor_id', 'contractor', 'id');
	}

	public function safeDown()
	{
    echo "just clear the table from phpmyadmin...\n";
	}
}
