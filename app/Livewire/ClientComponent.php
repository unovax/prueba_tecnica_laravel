<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientComponent extends Component
{
    public $clients = [];
    public $name;
    public $lastname;
    public $address;
    public $phone;

    public $client_id;

    public $clientSelected = null;

    public $clientModal = false;
    public $deleteModal = false;

    public function render()
    {
        $this->clients = Client::all();
        return view('livewire.client-component')->layout('layouts.app');
    }

    public function saveClient(){
        if($this->client_id){
            $this->updateClient();
        }
        else{
            $this->createClient();
        }
    }

    private function createClient(){
        $this->validate([
            'name'=> 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'address'=> 'required|string|max:255',
            'phone'=> 'required|numeric|digits:10|unique:clients,phone',
        ]);
        try {
            Client::create([
                'name'=> $this->name,
                'lastname'=> $this->lastname,
                'address'=> $this->address,
                'phone'=> $this->phone,
            ]);

            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");
            $this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }
    public function editClient(Client $client){
        $this->clientSelected = $client;
        $this->name = $client->name;
        $this->lastname = $client->lastname;
        $this->address = $client->address;
        $this->phone = $client->phone;
        $this->client_id = $client->id;
        $this->clientModal = true;
    }

    public function updateClient(){
        $this->validate([
            'name'=> 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'address'=> 'required|string|max:255',
            'phone'=> 'required|numeric|digits:10|unique:clients,phone,'.$this->client_id,
        ]);
        try {
            $this->clientSelected->update([
                'name'=> $this->name,
                'lastname'=> $this->lastname,
                'address'=> $this->address,
                'phone'=> $this->phone,
            ]);
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");
            $this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }

    public function setClientToDelete(Client $client){
        $this->clientSelected = $client;
        $this->deleteModal = true;
    }

    public function deleteClient(){
        try {
            $this->clientSelected->delete();
            $this->dispatch("showToast", message: "Catalogo creado correctamente", color: "#2F9E66");
            $this->erase();
        } catch (\Throwable $th) {
            $this->dispatch("showToast", message: "Error al crear el catalogo", color: "#CC1F1A");
        }
    }

    public function erase(){
        $this->name = '';
        $this->lastname = '';
        $this->address = '';
        $this->phone = '';
        $this->client_id = '';
        $this->clientModal = false;
        $this->deleteModal = false;
        $this->clientSelected = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
