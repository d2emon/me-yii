<?php

class m140919_225636_user_validation extends CDbMigration
{
	public function up()
	{
        $this->addColumn('users', 'validation',   'VARCHAR(16) NOT NULL');
        $this->addColumn('users', 'is_validated', 'bool');
        $this->addColumn('users', 'is_banned',    'bool');
	}

	public function down()
	{
		$this->dropColumn('users', 'validation');
        $this->dropColumn('users', 'is_validated');
        $this->dropColumn('users', 'is_banned');
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