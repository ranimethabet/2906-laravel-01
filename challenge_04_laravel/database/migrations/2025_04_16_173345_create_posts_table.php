<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longtext('body');

            //$table->unsignedbiginteger('post_id');
            //$table->foreign('post_status_id')->references('id')->on('post_statuses')->ondelete('cascade')
//on delete cascade means if the post status  is deleted  the post will be deleted ?
            $table->foreignId('post_status_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
