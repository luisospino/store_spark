<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configuracion extends Migration
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
			],
			'rfc' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
			],	
			'telefono' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
			],	
			'correo' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
			],
			'direccion' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
			],
			'leyenda' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('configuracion');
	}

	public function down()
	{
		$this->forge->dropTable('configuracion');
	}
}
