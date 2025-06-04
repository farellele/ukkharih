<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PKLResource\Pages;
use App\Models\PKL;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Model;

class PKLResource extends Resource
{
    protected static ?string $model = PKL::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('siswa_id')
                    ->label('Siswa')
                    ->relationship('siswa', 'nama')
                    ->required(),

                Forms\Components\Select::make('industri_id')
                    ->label('Industri')
                    ->relationship('industri', 'nama')
                    ->required(),

                Forms\Components\Select::make('guru_id')
                    ->label('Guru')
                    ->relationship('guru', 'nama')
                    ->required(),

                Forms\Components\DateTimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required(),

                Forms\Components\DateTimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')->label('Siswa'),
                Tables\Columns\TextColumn::make('status_pkl')->label('Status PKL')->sortable(),
                Tables\Columns\TextColumn::make('industri.nama')->label('Industri'),
                Tables\Columns\TextColumn::make('guru.nama')->label('Guru'),
                Tables\Columns\TextColumn::make('waktu_mulai')->dateTime()->label('Mulai'),
                Tables\Columns\TextColumn::make('waktu_selesai')->dateTime()->label('Selesai'),
            ])
            ->actions([
                EditAction::make()->visible(fn ($record) => auth()->user()->can('update pkls')),
                DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()->can('delete pkls') && $record->status_pkl !== 'Sedang PKL'),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->before(fn ($records) => $records->reject(fn ($record) => $record->status_pkl === 'Sedang PKL'))
                    ->requiresConfirmation(),
            ]);
    }

    public static function delete(Model $record): void
    {
        if (!auth()->user()->can('delete pkls') || $record->status_pkl === 'Sedang PKL') {
            abort(403, 'Unauthorized');
        }
        $record->delete();
    }

    public static function edit(Model $record): void
    {
        if (!auth()->user()->can('update pkls')) {
            abort(403, 'Unauthorized');
        }
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPKLS::route('/'),
            'create' => Pages\CreatePKL::route('/create'),
            'edit' => Pages\EditPKL::route('/{record}/edit'),
        ];
    }
}
