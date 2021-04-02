<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
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
			'usuario' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'unique'		=> true
			],
			'clave' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '250',
			],
			'nombre' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
			],
			'id_caja' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
				'unique'		=> true
			],
			'id_rol' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
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
		$this->forge->addForeignKey('id_caja','cajas','id');
		$this->forge->addForeignKey('id_rol','roles','id');

		$this->forge->createTable('usuarios');

		$this->db->enableForeignKeyChecks();
		
	}

	public function down()
	{
		$this->forge->dropTable('usuarios');
	}
}
