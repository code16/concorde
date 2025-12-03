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
            $table->text('heading_text')->nullable();
            $table->text('item_text')->nullable();
            $table->string('color')->nullable();
            $table->string('accent_color')->nullable();
            $table->json('tags')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('has_show_page')->default(false);
        });
    }
};
