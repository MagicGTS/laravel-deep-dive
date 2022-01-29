<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::table('users', function (Blueprint $table) {
            DB::statement("ALTER TABLE ".DB::getTablePrefix()."users CHANGE created_at created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
            DB::statement("ALTER TABLE ".DB::getTablePrefix()."users CHANGE updated_at updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$table->timestamp('last_login_at')->nullable()->after('updated_at');
			$table->boolean('is_active')->default(1)->after('last_login_at');
			$table->boolean('is_admin')->default(0)->after('is_active');
			$table->unique('name');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('last_login_at');
            $table->dropColumn('is_active');
            $table->dropUnique(['name']);
            DB::statement("ALTER TABLE ".DB::getTablePrefix()."users CHANGE created_at created_at TIMESTAMP NULL");
            DB::statement("ALTER TABLE ".DB::getTablePrefix()."users CHANGE updated_at updated_at TIMESTAMP NULL");
          });
    }
}
