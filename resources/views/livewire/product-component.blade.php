<div>
    <x-slot:title>Producto</x-slot:title>
    <section class="flex justify-end gap-2 p-1">
        <x-buttons.primary wire:click="$set('productModal', true)" text="Nuevo producto" />
    </section>
    <div class="grid flex-1 gap-1 p-1 overflow-auto">
        <table>
            <thead>
                <tr>
                    <th class="w-1/12">Acciones</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <x-buttons.primary wire:click="editProduct({{ $product->id }})" text="Editar" />
                                <x-buttons.danger wire:click="setProductToDelete({{ $product->id }})" text="Eliminar" />
                            </div>
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-dialog-modal wire:model='productModal'>
        <x-slot:title>
            {{ $product_id ? 'Editar producto' : 'Nuevo producto' }}
        </x-slot:title>
        <x-slot name="content">
            <form class="grid gap-2">
                <x-input label="Nombre" placeholder="Ingresa el nombre del producto" wire:model='name' />
                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <x-input label="Descripción" placeholder="Ingresa la descripción del producto" wire:model='description' />
                @error('description')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <section class="flex justify-end gap-2">
                    <x-buttons.primary wire:click='saveProduct' text="Guardar" />
                    <x-buttons.danger wire:click="erase" text="Cancelar" />
                </section>
            </form>
        </x-slot>
    </x-dialog-modal>
    <x-confirmation-modal wire:model='deleteModal'>
        <x-slot:title>Eliminar producto</x-slot:title>
        <x-slot name="content">
            <p>¿Estás seguro de eliminar este producto?</p>
        </x-slot>
        <x-slot:footer>
            <x-buttons.primary wire:click='deleteProduct' text="Eliminar" />
            <x-buttons.danger wire:click="erase" text="Cancelar" />
        </x-slot:footer>
    </x-confirmation-modal>
</div>
