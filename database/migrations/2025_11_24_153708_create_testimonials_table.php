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
        $this->createOzuTable('testimonials');

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('author_name')->nullable();
            $table->string('author_role')->nullable();
        });
    }
};
