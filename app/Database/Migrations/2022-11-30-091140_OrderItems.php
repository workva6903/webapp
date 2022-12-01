<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            '	item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'item_qty' => [
                'type' => 'INT',
                'null' => false,
            ],
            'order_id' => [
                'type' => 'INT',
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
        $this->forge->createTable('order_items', true);
    }

    public function down()
    {
        $this->forge->dropTable('order_items', true);
    }
}
