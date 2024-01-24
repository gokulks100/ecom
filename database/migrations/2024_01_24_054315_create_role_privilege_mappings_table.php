<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        Schema::create('role_privilege_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fk_role_id')->unsigned();
            // $table->foreign('fk_role_id')->references('id')->on('roles');
            $table->bigInteger('fk_privilege_id')->unsigned();
            // $table->foreign('fk_privilege_id')->references('id')->on('privilege_master');
            $table->text('actions')->nullable();
            $table->boolean('is_active')->default('1');
            $table->boolean('is_enabled')->default('1');
            $table->bigInteger('created_by')->unsigned();
            // $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned();
            // $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        $privilege_masters = DB::table('privilage_master')->get();
        $forAdmin = array();
        foreach ($privilege_masters as $privilege_master) {
            $a = [
                'fk_role_id' => 1,
                'fk_privilege_id' => $privilege_master->id,
                'created_by' => 1,
                'updated_by' => 1,
                'is_enabled' => 0,
                'actions' =>  $privilege_master->route_action
            ];
            $forAdmin[] = $a;
        }

        DB::table('role_privilege_mapping')->insert($forAdmin);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_privilege_mappings');
    }
};
