<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cat_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cat_image' => [
                'type' => 'text',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                // 'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                // 'null' => false,
            ]
           
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('category', true);
    }

    public function down()
    {
        $this->forge->dropTable('category', true);
    }
}
