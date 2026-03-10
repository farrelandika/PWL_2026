<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([

                        Tab::make('Product Info')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),
                            ]),

                        Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            ->badge(fn ($record) => $record->stock)
                            ->badgeColor(fn ($record) => $record->stock > 10 ? 'success' : 'danger')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->icon('heroicon-o-currency-dollar'),

                                TextEntry::make('stock')
                                    ->label('Stock'),
                            ]),

                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                IconEntry::make('is_active')
                                    ->label('Is Active')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured')
                                    ->boolean(),
                            ]),
                    ])
            ]);
    }
}