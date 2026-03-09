<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('published_at'),

                TextInput::make('title')
                    ->required()
                    ->minLength(5),

                Checkbox::make('published'),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),

                ColorPicker::make('color'),

                RichEditor::make('content'),

                FileUpload::make('image')
                    ->disk('public')
                    ->directory('post'),

                TagsInput::make('tags'),

            ]);
    }
}