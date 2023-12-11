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
        Schema::table('brands',function(Blueprint $table){
            $table->string('slug')->unique();
            $table->boolean('status')->comment('0:Inactive,1:Active');
            $table->boolean('is_delete')->comment('0:Not delete,1:Delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
