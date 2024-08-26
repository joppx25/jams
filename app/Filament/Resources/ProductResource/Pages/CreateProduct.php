<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\ProductImage;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    // protected function afterCreate()
    // {
    //     $product = $this->record;
    //     $formData = $this->form->getState();
    //     // dd($this->form->getState(), $this->record);
    //     $productImages = [];
    //     if (!empty($formData['product_images'])) {
    //         foreach ($formData['product_images'] as $image) {
    //             $productImages[] = [
    //                 'product_id' => $product->id,
    //                 'image'      => $image,
    //             ];
    //         }

    //         ProductImage::insert($productImages);
    //     }
    // }
}
