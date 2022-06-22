<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
// use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;

class DatabaseController extends Controller
{
   public function productTable(){
        Schema::create('product',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('content');
            $table->boolean('active');
            $table->timestamps();
        });
        echo("hmmm");
   }
    public function newTable()
    {
        Schema::create('new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('content');
            $table->boolean('active');
            $table->timestamps();
        });
        echo ("hmm2");
    }
    public function getAllData() {
       
        $this->productTable();
        $this->newTable();
        
    }
}