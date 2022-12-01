<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'order_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
            ],
            'order_date' => [
                'type' => 'DATETIME',
            ],
            'order_status' => [
                'type' => 'ENUM("Pending", "Accepted","Out_for_delivery", "Delivered")',
                'default' => 'Pending',
                'null' => false,
            ],
            'image' => [
                'type' => 'text',
                'null' => false,
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'order_type' => [
                'type' => 'ENUM("Online", "COD")',
                'default' => 'COD',
                'null' => false,
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
        $this->forge->createTable('order', true);
    }

    public function down()
    {
        $this->forge->dropTable('order', true);
    }
}
