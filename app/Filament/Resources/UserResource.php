<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
// use App\Filament\Resources\UserResource\RelationManagers;
// use App\Models\Role;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $slug = 'users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Section::make('Informasi Akun')
                //     ->schema([
                        
                //         Forms\Components\TextInput::make('name')
                //             ->label('Nama Lengkap')
                //             ->required(),

                //         Forms\Components\TextInput::make('email')
                //             ->email()
                //             ->required(),

                //         Forms\Components\TextInput::make('phone')
                //             ->label('No. HP'),

                //         Forms\Components\Select::make('branch_id')
                //             ->label('Cabang')
                //             ->options(Branch::query()->pluck('name', 'id'))
                //             ->searchable(),


                //         Forms\Components\Toggle::make('is_active')
                //             ->label('Aktif')
                //             ->default(true),
                //     ])
                //     ->columns(2),
                

Section::make('Informasi Akun')
    ->schema([
        Grid::make(2)->schema([
            TextInput::make('name')->label('Nama Lengkap')->required(),
            TextInput::make('email')->email()->required(),
            Select::make('branch_id')
                ->label('Cabang')
                ->relationship('branch', 'name')
                ->required(),
            Toggle::make('is_active')->label('Aktif'),
        ]),
    ]),

Section::make('Peran Pengguna (Roles)')
    ->schema([
        Select::make('roles')
            ->label('Roles')
            ->multiple()
            ->relationship('roles', 'name')
            ->preload()
            ->helperText('Pilih satu atau lebih peran yang dimiliki user ini'),
    ]),

                Forms\Components\Section::make('Keamanan')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Login Terakhir')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('branch_id')
                    ->label('Cabang')
                    ->options(Branch::pluck('name', 'id')),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
