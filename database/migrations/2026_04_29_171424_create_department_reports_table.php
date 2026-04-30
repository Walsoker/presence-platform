<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('department_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->foreignId('chef_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->unique(['department_id', 'date']); // Un seul rapport par jour par département
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_reports');
    }
};
