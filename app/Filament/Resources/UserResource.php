<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction; // Gunakan DeleteBulkAction untuk bulk delete
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Full Name')->required()->maxLength(255),
                TextInput::make('email')->label('Email Address')->email()->required()->unique(ignoreRecord: true)->maxLength(255),
                Select::make('status')->label('Approval Status')->options(['pending' => 'Pending', 'approved' => 'Approved'])->required(),
                Select::make('role_id')->label('User Role')->relationship('role', 'name')->required()->exists('roles', 'id'),
                DateTimePicker::make('created_at')->label('Created At')->disabled()->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('status')->badge()->sortable(),
                TextColumn::make('role.name')->label('Role')->sortable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')->label('Filter by Status')->options(['pending' => 'Pending', 'approved' => 'Approved']),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (?User $record) {
                        if (is_null($record)) {
                            throw new \Exception('Data pengguna tidak ditemukan.');
                        }
                        if (!$record instanceof User) {
                            throw new \Exception('Record bukan instance dari User.');
                        }
                        if ($record->isSuperAdmin()) {
                            throw new \Exception('Super admin tidak bisa dihapus.');
                        }
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make() // Gunakan DeleteBulkAction untuk aksi bulk delete
                    ->before(function ($records) {
                        foreach ($records as $record) {
                            if ($record->isSuperAdmin()) {
                                throw new \Exception('Super admin tidak bisa dihapus.');
                            }
                        }
                    })
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withTrashed() // Gunakan jika model memiliki SoftDeletes
            ->with('role'); // Pastikan relasi role di-load
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
