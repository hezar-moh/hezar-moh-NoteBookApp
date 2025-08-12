<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('image');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // above Laravel assumes you're referencing the users table — because the column is named user_id.
            // 🔍 Laravel derives the table name by removing _id and pluralizing the result (i.e., user → users).
            
            // If your table is named something else, like members, you must specify it:
                // $table->foreignId('user_id')->constrained('members');
                //This creates a column named user_id in your table.

              // This column is a foreign key that points to the id column in the members table.
             // So, user_id links to members.id. It ensures that any value in user_id must exist in the members table.
        });
    }

// 🔍 What ->constrained() does:
// By default, ->constrained() assumes:
// The referenced table is users
// The referenced column is id

//### If you want to automatically delete notes when the associated user is deleted:
// $table->foreignId('user_id')->constrained()->onDelete('cascade');

















    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
