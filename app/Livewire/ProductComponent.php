<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductComponent extends Component
{
    public $products = [];
    public $name;
    public $description;

    public $product_id;

    public $productSelected = null;

    public $productModal = false;
    public $deleteModal = false;

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.product-component')->layout('layouts.app');
    }

    public function saveProduct(){
        if($this->product_id){
            $this->updateProduct();
        }
        else{
            $this->createProduct();
        }
    }

    private function createProduct(){
        $this->validate([
            'name'=> 'required|string|max:255',
            'description'=> 'required|string|max:255',
        ]);
        try {
            Product::create([
                'name'=> $this->name,
                'description'=> $this->description,
                'img_path'=> 'default.jpg',
            ]);
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }

    public function editProduct(Product $product){
        $this->productSelected = $product;
        $this->name = $product->name;
        $this->lastname = $product->lastname;
        $this->address = $product->address;
        $this->phone = $product->phone;
        $this->product_id = $product->id;
        $this->productModal = true;
    }

    public function updateProduct(){
        $this->validate([
            'name'=> 'required|string|max:255',
            'description'=> 'required|string|max:255',
        ]);
        try {
            $this->productSelected->update([
                'name'=> $this->name,
                'description'=> $this->description,
            ]);
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }

    public function setProductToDelete(Product $product){
        $this->productSelected = $product;
        $this->deleteModal = true;
    }

    public function deleteProduct(){
        try {
            $this->productSelected->delete();
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al elimianr el catalogo ", color: "#CC1F1A");
        }
    }

    public function erase(){
        $this->name = '';
        $this->description = '';
        $this->product_id = '';
        $this->productModal = false;
        $this->deleteModal = false;
        $this->productSelected = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
