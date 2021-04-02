<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productos extends Migration
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
			'codigo' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '20',
				'unique'		=> true
			],
			'nombre' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '200',
				'unique'		=> true
			],
			'precio_venta' => [
				'type'       	=> 'DECIMAL',
				'constraint' 	=> '10,2',
			],
			'precio_compra' => [
				'type'       	=> 'DECIMAL',
				'constraint' 	=> '10,2',
				'default'		=> 0
			],
			'existencias' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'default'		=> 0
			],
			'stock_minimo' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'default'		=> 0
			],
			'inventariable' => [
				'type'       	=> 'TINYINT'
			],
			'id_unidad' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unique'		=> true
			],
			'id_categoria' => [
				'type' 			=> 'INT',
				'constraint' 	=> 11,
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
		
		$this->forge->addForeignKey('id_unidad','unidades','id');
		$this->forge->addForeignKey('id_categoria','categorias','id');

		$this->forge->createTable('productos');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('productos');
	}
}
