<nav
    x-data="{
        show: true,
        toggleSidebar() {
            this.show = !this.show
        }
    }"
    x-show="show" class="absolute md:relative h-full w-full md:max-w-[250px] bg-sidebar flex flex-col overflow-hidden">
    <div class="flex items-center justify-between p-2">
        <h1 class="text-secondary">{{ env("APP_NAME") }}</h1>
        <button x-on:click="toggleSidebar" class="text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <ul class="flex flex-col flex-1 p-1 overflow-auto">
        <a href="/servicios" class="w-full px-4 py-2 transition-colors duration-300 rounded-md bg-sidebar hover:bg-sidebar-hover text-secondary">Servicios</a>
        <a href="/clientes" class="w-full px-4 py-2 transition-colors duration-300 rounded-md bg-sidebar hover:bg-sidebar-hover text-secondary">Clientes</a>
        <a href="/productos" class="w-full px-4 py-2 transition-colors duration-300 rounded-md bg-sidebar hover:bg-sidebar-hover text-secondary">Productos</a>
    </ul>
</nav>
