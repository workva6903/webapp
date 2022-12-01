<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'product_desc' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'qty' => [
                'type' => 'INT',
                'null' => false,
            ],
            'mrp' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
            ],
            'selling_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
            ],
            'product_image' => [
                'type' => 'text',
                'null' => false,
            ],
            'product_cat_id' => [
                'type'      => 'INT',
                'unsigned'  => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                // 'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                // 'null' => false,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
