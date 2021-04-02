<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
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
				'constraint' 	=> '100',
			],
			'direccion' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'null' 			=> true
			],
			'telefono' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
				'unique' 		=> true,
				'null' 			=> true
			],
			'correo' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'unique' 	=> true,
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
		$this->forge->createTable('clientes');
	}

	public function down()
	{
		$this->forge->dropTable('clientes');
	}
}
