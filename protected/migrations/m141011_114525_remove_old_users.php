<?php

class m141011_114525_remove_old_users extends CDbMigration
{
	public function up()
	{
        $this->dropTable('users');
	}

	public function down()
	{
        $this->createTable('users', array(
            'user_id'      => 'pk',
            'username'     => 'VARCHAR(8) NOT NULL',
            'password'     => 'VARCHAR(64) NOT NULL',
            'email'        => 'VARCHAR(128)',
            'validation'   => 'VARCHAR(16) NOT NULL',
            'is_validated' => 'bool',
            'is_banned'    => 'bool',
        ));
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