<?php

class m140920_091853_longer_password extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('users', 'password', 'VARCHAR(64)');
	}

	public function down()
	{
        $this->alterColumn('users', 'password', 'VARCHAR(32)');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}