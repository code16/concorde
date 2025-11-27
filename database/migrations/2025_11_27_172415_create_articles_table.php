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
        $this->createOzuTable('articles');

        Schema::table('articles', function (Blueprint $table) {
            $table->string('category_label')->nullable();
            $table->dateTime('publication_date');
        });
    }
};
