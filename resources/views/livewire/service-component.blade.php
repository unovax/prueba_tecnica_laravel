<div>
    <x-slot:title>Servicio de reparación</x-slot:title>
    <section class="flex justify-end gap-2 p-1">
        <x-input placeholder="Busqueda" wire:model.live.debounce.500ms='search'/>
        <x-buttons.primary wire:click="$set('repServiceModal', true)" text="Nuevo servicio de reparación" />
    </section>
    <div class="grid flex-1 gap-1 p-1 overflow-auto">
        <table>
            <thead>
                <tr>
                    <th class="w-1/12">Acciones</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Notas</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rep_services as $rep_service)
                    <tr>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <x-buttons.primary wire:click="editRepService({{ $rep_service->id }})" text="Editar" />
                                <x-buttons.danger wire:click="setRepServiceToDelete({{ $rep_service->id }})"
                                    text="Eliminar" />
                            </div>
                        </td>
                        <td>{{ $rep_service->client_product?->client->name ?? "Sin cliente" }}</td>
                        <td>{{ $rep_service->client_product?->product->name ?? "Sin producto" }}</td>
                        <td>{{ $rep_service->notes }}</td>
                        <td>{{ $status[$rep_service->status] ?? "Sin estado"}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-dialog-modal wire:model='repServiceModal'>
        <x-slot:title>
            {{ $rep_service_id ? 'Editar servicio de reparación' : 'Nuevo servicio de reparación' }}
        </x-slot:title>
        <x-slot name="content">
            <form class="grid gap-2">
                <label>
                    Cliente
                    <select class="input" wire:model='client_id'>
                        <option value="{{ null }}">Selecciona una opción</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </label>
                @error('client_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <label>
                    Producto
                    <select class="input" wire:model='product_id'>
                        <option value="{{ null }}">Selecciona una opción</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </label>
                @error('product_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Precio" placeholder="Ingresa el precio del producto" wire:model="price" />
                @error('price')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Descripción" placeholder="Ingresa la descripcion del producto" wire:model="description" />
                @error('description')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Notas" placeholder="Ingresa notas del servicio" wire:model="notes" />
                @error('notes')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                @if ($rep_service_id)
                    <label>
                        Estado
                        <select class="input" wire:model='status_char'>
                            <option value="{{ null }}">Selecciona una opción</option>
                            <option value="P">Pendiente</option>
                            <option value="R">Cancelado</option>
                            <option value="T">En Proceso</option>
                            <option value="F">Finalizado</option>
                        </select>
                    </label>
                    @error('status_char')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                @endif
                <section class="flex justify-end gap-2">
                    <x-buttons.primary wire:click='saveRepService' text="Guardar" />
                    <x-buttons.danger wire:click="erase" text="Cancelar" />
                </section>
            </form>
        </x-slot>
    </x-dialog-modal>
    <x-confirmation-modal wire:model='deleteModal'>
        <x-slot:title>Eliminar servicio de reparación</x-slot:title>
        <x-slot name="content">
            <p>¿Estás seguro de eliminar este servicio de reparación?</p>
        </x-slot>
        <x-slot:footer>
            <x-buttons.primary wire:click='deleteRep_service' text="Eliminar" />
            <x-buttons.danger wire:click="erase" text="Cancelar" />
        </x-slot:footer>
    </x-confirmation-modal>
</div>
