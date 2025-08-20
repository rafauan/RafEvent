<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Featured Image')
                    ->disk('public')
                    ->directory('uploads/events')
                    ->image()
                    ->preserveFilenames()
                    ->maxSize(51200) // 50 MB
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('excerpt')
                    ->nullable()
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->helperText('A short summary of the event, displayed on the event listing page.'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->nullable()
                    ->preload()
                    ->searchable()
                    ->label('Category'),
                Forms\Components\DateTimePicker::make('start_datetime')
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->label('Duration (minutes)')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Duration in minutes. This field replaces the end date and time.'),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Featured Image')
                    ->disk('public')
                    ->height('50')
                    ->size(50),
                Tables\Columns\TextColumn::make('start_datetime')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration (minutes)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
