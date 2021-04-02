<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Compras extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'folio' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
			],
			'total' => [
				'type'       	=> 'DECIMAL',
				'constraint' 	=> '10,2',
			],
			'id_usuario' => [
				'type' 			=> 'INT',
				'constraint' 	=> 11,
				'unique'		=> true,
			],
			'activo' => [
				'type' 			=> 'TINYINT',
				'null' 			=> false,
				'default'		=> 1
			],
			'fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()'
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_usuario','usuarios','id');
		$this->forge->createTable('compras');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('compras');
	}
}
