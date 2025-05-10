<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfilesAddDetailedAddressFields extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (Schema::hasColumn('profiles', 'address')) {
                $table->dropColumn('address');
            }

            if (!Schema::hasColumn('profiles', 'address_line_1')) {
                $table->string('address_line_1')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'address_line_2')) {
                $table->string('address_line_2')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'state')) {
                $table->string('state')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'postal_code')) {
                $table->string('postal_code')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'country')) {
                $table->string('country')->nullable();
            }

            if (!Schema::hasColumn('profiles', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'address_line_1',
                'address_line_2',
                'city',
                'state',
                'postal_code',
                'country',
            ]);

            $table->string('address')->nullable();
        });
    }
}