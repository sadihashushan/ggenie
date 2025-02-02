<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupermarketResource\Pages;
use App\Filament\Resources\SupermarketResource\RelationManagers;
use App\Models\Supermarket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class SupermarketResource extends Resource
{
    protected static ?string $model = Supermarket::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Supermarket Details')
                    ->schema([
                        Grid::make(2) 
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxlength(225)
                                    ->live(onBlur:true)
                                    ->afterStateUpdated(function(string $operation, $state, Set $set){
                                        if ($operation !== 'create'){
                                            return;
                                        }
                                        $set ('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxlength(225)
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(Supermarket::class, 'slug', ignoreRecord:true),

                                MarkdownEditor::make('description')
                                    ->columnSpanFull(),

                                TextInput::make('location')
                                    ->required()
                                    ->maxlength(255),

                                FileUpload::make('images')
                                    ->image()
                                    ->directory('supermarkets')
                                    ->disk('public'),
                            ]),

                        // Available Times Section
                        Section::make('Available Times')
                            ->schema([
                                TextArea::make('available_times')
                                    ->label('Available Times (JSON format)')
                                    ->helperText('Enter available times in JSON format, e.g., {"monday": "9:00 AM - 6:00 PM", "sunday": "closed"}')
                                    ->columnSpanFull()
                                    ->required(),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListSupermarkets::route('/'),
            'create' => Pages\CreateSupermarket::route('/create'),
            'edit' => Pages\EditSupermarket::route('/{record}/edit'),
        ];
    }
}
