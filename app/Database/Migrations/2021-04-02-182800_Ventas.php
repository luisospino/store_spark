<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ventas extends Migration
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
				'unique'		=> true
			],
			'total' => [
				'type'       	=> 'DECIMAL',
				'constraint' 	=> '10,2',
			],
			'id_usuario' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
				'unique'		=> true
			],
			'id_caja' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
				'unique'		=> true
			],
			'id_cliente' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
				'unique'		=> true
			],
			'id_metodo_pago' => [
				'type' 			=> 'INT',
				'constraint'     => 11,
				'unique'		=> true
			],
			'activo' => [
				'type' 			=> 'TINYINT',
				'null' 			=> false,
				'default'		=> 1
			],
			'fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()'
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_caja','cajas','id');
		$this->forge->addForeignKey('id_cliente','clientes','id');
		$this->forge->addForeignKey('id_metodo_pago','metodo_pago','id');
		$this->forge->addForeignKey('id_usuario','usuarios','id');

		$this->forge->createTable('ventas');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('ventas');
	}
}
