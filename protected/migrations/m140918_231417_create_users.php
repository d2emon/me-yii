<?php

class m140918_231417_create_users extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'user_id'  => 'pk',
            'username' => 'VARCHAR(8) NOT NULL',
            'password' => 'VARCHAR(32) NOT NULL',
            'email'    => 'VARCHAR(128)',
        ));

	}

	public function down()
	{
        $this->dropTable('users');
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