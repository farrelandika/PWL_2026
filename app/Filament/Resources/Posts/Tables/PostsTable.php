<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        
        return $table
    ->columns([
        TextColumn::make('title')
            ->sortable()
            ->toggleable()
            ->searchable(),

        TextColumn::make('tags')
            ->label('Tags')
            ->toggleable(isToggledHiddenByDefault: true),

        TextColumn::make('id')
            ->label('ID')
            ->toggleable(),

        IconColumn::make('published')
            ->boolean()
            ->toggleable()
            ->label('Published'),

        TextColumn::make('slug')
            ->sortable()
            ->toggleable()
            ->searchable(),

        TextColumn::make('category.name')
            ->label('Category')
            ->sortable()
            ->toggleable()
            ->searchable(),

        ColorColumn::make('color')
            ->toggleable(),

        ImageColumn::make('image')
            ->toggleable()
            ->disk('public'),

        TextColumn::make('created_at')
            ->toggleable()
            ->label('Created At')
            ->dateTime()
            ->sortable(),
    ])
    ->filters([

        SelectFilter::make('category_id')
            ->label('Select Category')
            ->relationship('category', 'name')
            ->preload(),

        Filter::make('created_at')
            ->label('Creation Date')
            ->schema([
                DatePicker::make('created_at')
                    ->label('Select Date'),
            ])
            ->query(function ($query, $data) {
                return $query->when(
                    $data['created_at'],
                    fn ($query, $date) => $query->whereDate('created_at', $date)
                );
            }),

            

    ])

    ->defaultSort('created_at', 'desc');
    }
}