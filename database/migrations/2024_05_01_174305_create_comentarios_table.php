
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
        // post_id, comentario, estado, fecha, usuario_id
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts');
            $table->text('comentario');
            $table->boolean('estado')->default(true);
            $table->dateTime('fecha')->nullable();
            $table->foreignId('usuario_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
