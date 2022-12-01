<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'cost' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
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
        $this->forge->createTable('cart', true);
    }

    public function down()
    {
        $this->forge->dropTable('cart', true);
    }
}
