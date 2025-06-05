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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->text('alamat');
            $table->string('kontak')->unique();
            $table->string('email');
            $table->enum('status_pkl', ['Belum PKL', 'Sedang PKL', 'Selesai PKL']);
            $table->timestamps();
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->label('Nama')->required(),
                Forms\Components\TextInput::make('nis')->label('NIS')->required()->unique(),
                Forms\Components\Select::make('gender')->label('Gender')->options([
                    'Pria' => 'Pria',
                    'Wanita' => 'Wanita',
                ])->required(),
                Forms\Components\TextInput::make('kontak')->label('Kontak')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email(),
                Forms\Components\Select::make('status_pkl')->label('Status PKL')->options([
                    'Belum PKL' => 'Belum PKL',
                    'Sedang PKL' => 'Sedang PKL',
                    'Selesai PKL' => 'Selesai PKL',
                ])->default('Belum PKL')->required(),
            ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};