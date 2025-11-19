<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPassivesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('passives');
    }
    
}
