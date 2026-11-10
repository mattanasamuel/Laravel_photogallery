<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('album_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('category_name', 128)->index(); //
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //se eliminiamo l'utente vengono eliminati i record, on cascade
            //$table->foreignIdFor(User::class); //approccio model-driven, estrapola la fk in automatico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albumCategories');
    }
};
