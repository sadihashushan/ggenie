<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenieResource\Pages;
use App\Filament\Resources\GenieResource\RelationManagers;
use App\Models\Genie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GenieResource extends Resource
{
    protected static ?string $model = Genie::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Genie Details')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Name'),

                                Forms\Components\TextInput::make('street_address')
                                    ->required()
                                    ->label('Street Address'),

                                Forms\Components\TextInput::make('city')
                                    ->required()
                                    ->label('City'),

                                Forms\Components\TextInput::make('age')
                                    ->required()
                                    ->numeric()
                                    ->label('Age'),

                                Forms\Components\TextInput::make('phone_number')
                                    ->required()
                                    ->label('Phone Number'),

                                Forms\Components\TextInput::make('email')
                                    ->required()
                                    ->email()
                                    ->label('Email'),
                                
                                Forms\Components\TextInput::make('password')
                                    ->required()
                                    ->label('Password'),

                                Forms\Components\FileUpload::make('image')
                                    ->label('Image')
                                    ->image()
                                    ->directory('genies')
                                    ->nullable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('street_address')
                    ->label('Street Address'),

                Tables\Columns\TextColumn::make('city')
                    ->label('City'),

                Tables\Columns\TextColumn::make('age')
                    ->label('Age'),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone Number'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListGenies::route('/'),
            'create' => Pages\CreateGenie::route('/create'),
            'edit' => Pages\EditGenie::route('/{record}/edit'),
        ];
    }
}
