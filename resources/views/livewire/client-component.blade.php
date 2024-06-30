<div>
    <x-slot:title>Clientes</x-slot:title>
    <section class="flex justify-end gap-2 p-1">
        <x-buttons.primary wire:click="$set('clientModal', true)" text="Nuevo cliente" />
    </section>
    <div class="grid flex-1 gap-1 p-1 overflow-auto">
        <table>
            <thead>
                <tr>
                    <th class="w-1/12">Acciones</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <x-buttons.primary wire:click="editClient({{ $client->id }})" text="Editar" />
                                <x-buttons.danger wire:click="setClientToDelete({{ $client->id }})" text="Eliminar" />
                            </div>
                        </td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->lastname }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-dialog-modal wire:model='clientModal'>
        <x-slot:title>
            {{ $client_id ? 'Editar cliente' : 'Nuevo cliente' }}
        </x-slot:title>
        <x-slot name="content">
            <form class="grid gap-2">
                <x-input label="Nombre" placeholder="Ingresa el nombre del cliente" wire:model='name' />
                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Apellido" placeholder="Ingresa el apellido del cliente" wire:model='lastname' />
                @error('lastname')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Dirección" placeholder="Ingresa la dirección del cliente" wire:model='address' />
                @error('address')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Telefono" placeholder="Ingresa el telefono del cliente" wire:model='phone' />
                @error('phone')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <section class="flex justify-end gap-2">
                    <x-buttons.primary wire:click='saveClient' text="Guardar" />
                    <x-buttons.danger wire:click="erase" text="Cancelar" />
                </section>
            </form>
        </x-slot>
    </x-dialog-modal>
    <x-confirmation-modal wire:model='deleteModal'>
        <x-slot:title>Eliminar cliente</x-slot:title>
        <x-slot name="content">
            <p>¿Estás seguro de eliminar este cliente?</p>
        </x-slot>
        <x-slot:footer>
            <x-buttons.primary wire:click='deleteClient' text="Eliminar" />
            <x-buttons.danger wire:click="erase" text="Cancelar" />
        </x-slot:footer>
    </x-confirmation-modal>
</div>
