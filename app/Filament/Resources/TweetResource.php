<?php

namespace App\Filament\Resources;

use App\Domain\News\Models\Tweet;
use App\Filament\Resources\TweetResource\Pages;
use App\Filament\Resources\TweetResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TweetResource extends Resource
{
    protected static ?string $model = Tweet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tweet_id'),
                Forms\Components\Textarea::make('text'),
                Forms\Components\TextInput::make('url')->nullable(),
                Forms\Components\Select::make('source')->options(['X', 'rss', 'reddit'])->default('X'),
                Forms\Components\DateTimePicker::make('posted_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tweet_id'),
                Tables\Columns\TextColumn::make('url'),
                Tables\Columns\TextColumn::make('source'),
                Tables\Columns\TextColumn::make('posted_at'),
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
            'index' => Pages\ListTweets::route('/'),
            'create' => Pages\CreateTweet::route('/create'),
            'edit' => Pages\EditTweet::route('/{record}/edit'),
        ];
    }
}
