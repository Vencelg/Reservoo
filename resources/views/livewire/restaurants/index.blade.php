<div class="w-1/2 m-auto p-7 bg-gray-200 rounded-xl">
    <x-form wire:submit="save">
        <div class="flex flex-row justify-between">
            <x-input placeholder="Search..." wire:model="name" />
            <x-dropdown label="Settings" class="btn-outline">
                <x-menu-item @click.stop="">
                    <x-checkbox label="Activate" />
                </x-menu-item>
            </x-dropdown>
        </div>

        <x-slot:actions>
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
