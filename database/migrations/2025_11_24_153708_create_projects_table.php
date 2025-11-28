<?php

use Code16\OzuClient\Support\Database\MigratesOzuTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use MigratesOzuTable;

    public function up(): void
    {
        $this->createOzuTable('projects');

        Schema::table('projects', function (Blueprint $table) {
            $table->string('heading_text')->nullable();
            $table->string('item_text')->nullable();
            $table->json('tags')->nullable();
        });
    }
};
