<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\RepService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $rep_services = [];
    public $price;
    public $description;
    public $notes;
    public $client_id;
    public $product_id;
    public $rep_service_id;

    public $repServiceSelected = null;

    public $repServiceModal = false;
    public $deleteModal = false;

    public $clients = [];
    public $products = [];
    public $search = null;
    public $status = [
        "P" => "Pendiente",
        "R" => "Rechazado / Cancelado",
        "T" => "En proceso",
        "F" => "Finalizado"
    ];
    public $status_char = "";

    public function render()
    {

        if ($this->search) {
            $search = $this->search;
            $this->rep_services = RepService::whereHas("client_product", function ($query) use ($search) {
                $query->whereHas("client", function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                    $query->orWhere("lastname", "like", "%" . $search . "%");
                });
                $query->orWhereHas("product", function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                });
            })->get();
        } else {
            $this->rep_services = RepService::all();
        }


        return view('livewire.service-component')->layout('layouts.app');
    }

    public function mount()
    {
        $this->clients = Client::all();
        $this->products = Product::all();
    }

    public function saveRepService()
    {
        if ($this->rep_service_id) {
            $this->updateRepService();
        } else {
            $this->createRepService();
        }
    }

    private function createRepService()
    {
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|decimal:0,2',
            'description' => "nullable|string|max:255",
            'notes' => "nullable|string|max:255",
        ]);
        DB::beginTransaction();
        try {
            //Crear producto del cliente
            $client_product = ClientProduct::create([
                'client_id' => $this->client_id,
                'product_id' => $this->product_id,
                'description' => $this->description,
            ]);
            //Crar servicio de reparacion con el id del producto del cliente
            RepService::create([
                'client_product_id' => $client_product->id,
                'price' => $this->price,
                'notes' => $this->notes,
            ]);
            DB::commit();
            $this->dispatch("showToast", message: "Servicio creado correctamente", color: "#2F9E66");
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch("showToast", message: "Error al crear el servicio", color: "#CC1F1A");
        }
    }

    public function editRepService(RepService $rep_service)
    {
        $this->repServiceSelected = $rep_service;
        $this->client_id = $rep_service->client_product->client_id;
        $this->product_id = $rep_service->client_product->product_id;
        $this->description = $rep_service->client_product->description;
        $this->price = $rep_service->price;
        $this->notes = $rep_service->notes;
        $this->rep_service_id = $rep_service->id;
        $this->repServiceModal = true;
    }

    public function updateRepService()
    {
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|decimal:0,2',
            'description' => "nullable|string|max:255",
            'notes' => "nullable|string|max:255",
            'status_char' => 'required|in:P,R,T,F'
        ]);
        try {
            /* $this->repServiceSelected->client_product->delete();
            //Crear producto del cliente
            $client_product = ClientProduct::create([
                'client_id' => $this->client_id,
                'product_id' => $this->product_id,
                'description' => $this->description,
            ]); */
            //Crar servicio de reparacion con el id del producto del cliente
            $this->repServiceSelected->update([
                //'client_product_id'=> $client_product->id,
                //'price'=> $this->price,
                //'notes' => $this->notes,
                'status' => $this->status_char
            ]);
            $this->dispatch("showToast", message: "Servicio actualizado correctamente", color: "#2F9E66");
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al actualizar el servicio", color: "#CC1F1A");
        }
    }

    public function setServiceToDelete(RepService $rep_service)
    {
        $this->repServiceSelected = $rep_service;
        $this->deleteModal = true;
    }

    public function deleteService()
    {
        try {
            $this->repServiceSelected->delete();
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");$this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }

    public function erase()
    {
        $this->price = '';
        $this->description = '';
        $this->notes = '';
        $this->client_id = '';
        $this->product_id = '';
        $this->rep_service_id = '';
        $this->status_char = '';
        $this->repServiceModal = false;
        $this->deleteModal = false;
        $this->repServiceSelected = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
