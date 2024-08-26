<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductSize;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-gift-top';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description'),
                TextInput::make('supplier_price')
                    ->prefix('₱')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),
                TextInput::make('price')
                    ->prefix('₱')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),
                Select::make('product_size_id')
                    ->options(ProductSize::all()->pluck('code', 'id'))
                    ->relationship(name: 'productSize', titleAttribute: 'code')
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        TextInput::make('code')->required(),
                    ])
                    ->required(),
                ColorPicker::make('color'),
                Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        TextInput::make('slug')->required()
                    ]),
                FileUpload::make('thumbnail_url')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->directory('thumbnails'),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Repeater::make('productImages')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Product Images')
                            ->disk('public')
                            ->directory('product_images'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_url')->label('Thumbnail'),
                TextColumn::make('name'),
                TextColumn::make('Category.name'),
                TextColumn::make('ProductSize.code'),
                TextColumn::make('description'),
                TextColumn::make('supplier_price')->money('php'),
                TextColumn::make('price')->money('php'),
                TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
