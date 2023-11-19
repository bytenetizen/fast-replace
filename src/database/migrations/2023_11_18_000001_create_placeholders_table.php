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
        Schema::create('placeholders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('piece')->comment('text key');
            $table->string('doer')->comment('full path class return str value');
            $table->unsignedBigInteger('admin_id');
            $table->text('comments');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletesDatetime();
            $table->index(['piece']);
            $table->unique(['piece','doer']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placeholders');
    }
};
