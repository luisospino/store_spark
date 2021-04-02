<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleCompra extends Migration
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
			'id_compra' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unique'		=> true
			],
			'id_producto' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unique'		=> true
			],
			'nombre' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '200',
			],
			'cantidad' => [
				'type' 			=> 'INT',
				'constraint' 	=> 11,
			],
			'precio' => [
				'type'       	=> 'DECIMAL',
				'constraint' 	=> '10,2',
			],
			'fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()'
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_compra','compras','id');
		$this->forge->addForeignKey('id_producto','productos','id');

		$this->forge->createTable('detalle_compra');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('detalle_compra');
	}
}
