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
        $this->createOzuTable('project_kpis');

        Schema::table('project_kpis', function (Blueprint $table) {
            $table->foreignId('parent_id')->constrained('projects')->cascadeOnDelete();
            $table->boolean('is_inverted')->default(false);
            $table->string('suffix')->nullable();
        });
    }
};
