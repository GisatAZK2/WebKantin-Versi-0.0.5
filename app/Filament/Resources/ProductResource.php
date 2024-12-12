<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Kategori;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nama Produk'),
            
            Forms\Components\Select::make('category_id')
                ->label('Kategori')
                ->options(Kategori::all()->pluck('Nama_kategori', 'id')) 
                ->searchable()
                ->required(),

                Forms\Components\TextArea::make('description')
                ->label('Description')
                ->required(),

            SpatieMediaLibraryFileUpload::make('images')
                ->collection('product_images') 
                ->label('Gambar Produk (Multiple)')
                ->multiple(),

               

            Forms\Components\Repeater::make('variants')
                ->relationship('variants')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Varian')
                        ->required(),

                    Forms\Components\TextInput::make('price')
                        ->label('Harga')
                        ->numeric()
                        ->required(),
                       

                    Forms\Components\TextInput::make('stock')
                        ->label('Stok')
                        ->numeric()
                        ->required(),

                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('variant_images') 
                        ->label('Gambar Varian'),
                ])
                ->hidden(fn ($livewire) => $livewire->data['price'] || $livewire->data['stock'])
                ->label('Varian Produk'),

            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->hidden(fn ($livewire) => count($livewire->data['variants']) > 0),

            Forms\Components\TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->hidden(fn ($livewire) => count($livewire->data['variants']) > 0),

            Forms\Components\Toggle::make('status')
                ->label('Status Aktif')
                ->default(true),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
    
                return $table
                ->columns([
                
                        Tables\Columns\TextColumn::make('name')
                        ->label('Nama Produk')
                        ->sortable()
                        ->searchable(),

        
                        Tables\Columns\ImageColumn::make('media')
                        ->label('Gambar Produk')
                        ->getStateUsing(function ($record) {
                        
                            return $record->getFirstMediaUrl('product_images');
                        })
                        ->toggleable(), 

                        Tables\Columns\TextColumn::make('kategori.Nama_kategori')
                        ->label('Kategori'),

                        Tables\Columns\TextColumn::make('description') 
                        ->limit(12)
                        ->label('Deskripsi'),

                        Tables\Columns\BooleanColumn::make('status')
                        ->label('Aktif'),


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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
