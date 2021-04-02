<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logs extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'id_usuario' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11
			],
			'evento' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '150',
			],
			'fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()',
			'ip' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
			],
			'detalles' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '150',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('logs');
	}

	public function down()
	{
		$this->forge->dropTable('logs');
	}
}
