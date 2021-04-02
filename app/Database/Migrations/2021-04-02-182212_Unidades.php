<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Unidades extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'nombre' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'unique'		=> true
			],
			'nombre_corto' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'unique'		=> true
			],
			'activo' => [
				'type' 			=> 'TINYINT',
				'null' 			=> false,
				'default'		=> 1
			],
			'fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()',
			'fecha_edit TIMESTAMP NULL'			
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('unidades');
	}

	public function down()
	{
		$this->forge->dropTable('unidades');
	}
}
