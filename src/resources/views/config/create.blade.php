<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Config Create"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form
        class="relative mt-7"
        method="POST"
        action="{{ route("LaravelBlock2Video.config.store", $element->id) }}"
    >
        @csrf
        <x-admin.atoms.required />

        <x-admin.atoms.row>
            <x-admin.atoms.label for="layout" class="required">
                Layout
            </x-admin.atoms.label>
            <x-admin.atoms.select name="layout" id="layout">
                <option value="">--Select Item--</option>
                @foreach (config("gmj.laravel_block2_video_config.layouts") as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach 
            </x-admin.atoms.select>
            @error("layout")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        <hr class="my-10">

        <div class="text-right">
            <x-admin.atoms.link
                href="{{ url()->previous() }}"
            >
                Back
            </x-admin.atoms.link>
            <x-admin.atoms.button id="save">
                Save
            </x-admin.atoms.button>
        </div>
    </form>
</x-admin.layout.app>
