<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Video"],
        ['name' => "Create"],
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form id="myform" method="POST"
        action="{{ route('LaravelBlock2Video.store', $element_id) }}" class="relative" enctype="multipart/form-data">

        <x-admin.atoms.required />
        @csrf

        <x-admin.atoms.row>
            <x-admin.atoms.checkbox value="is_youtube_link" name="is_youtube_link" checked="1">
                Is YouTube Link
            </x-admin.atoms.checkbox>
        </x-admin.atoms.row>

        <x-admin.atoms.row>
            <div id="youtube_link_wrapper">
                <x-admin.atoms.label for="youtube_link" class="required">
                    Youtube Link
                </x-admin.atoms.label>
                <x-admin.atoms.text name="youtube_link" class="w-full" id="youtube_link" />
            </div>
            @error("youtube_link")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        <x-admin.atoms.row>
            <div id="video_wrapper" class="hidden">
                <x-admin.atoms.label for="video" class="required">
                    Video (only accept mp4)
                </x-admin.atoms.label>
                <div class="mt-2">
                    <input
                        type="file"
                        name="video"
                        id="video"
                        class="upload-file-widget"/>
                </div>
                @error("video")
                    <x-admin.atoms.error>
                        {{ $message }}
                    </x-admin.atoms.error>
                @enderror
            </div>
        </x-admin.atoms.row>

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="text_{{ $locale }}">
                    Text ({{ $locale }})
                </x-admin.atoms.label>
                <div class="mt-2">
                    <textarea class="tinymce-textarea bg-white p-6" name="text_{{$locale}}">
                        <div class="text-lg md:text-2xl font-bold">Title</div>
                        <div>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eaque culpa sunt aliquam, debitis officiis quam vel modi! Dolores nulla harum numquam dolore reiciendis? Officia fugiat possimus earum pariatur repudiandae dolore eum dicta autem molestias ullam illum optio nostrum, rerum vitae exercitationem ab ratione ipsa quasi temporibus quas delectus magni eveniet fugit porro. Quibusdam tenetur debitis possimus, impedit inventore ex!
                        </div>
                    </textarea>
                </div>
            </x-admin.atoms.row>
        @endforeach

        <x-admin.atoms.row>
            <x-admin.atoms.page can_null />
        </x-admin.atoms.row>

        <hr class="my-10">

        <div class="text-right">
            <x-admin.atoms.link href="{{ url()->previous() }}">Back</x-admin.atoms.link>
            <x-admin.atoms.button class="ml-3" id="save">Save</x-admin.atoms.button>
        </div>
    </form>

    @push('js')
        <script>
            $("#is_youtube_link").on("change", toggle);

            const bool = $("#is_youtube_link").prop("checked");
            if(bool) {
                $("#youtube_link_wrapper").show();
                $("#video_wrapper").hide();
            } else {
                $("#youtube_link_wrapper").hide();
                $("#video_wrapper").show();
            }

            function toggle(){
                const bool = $("#is_youtube_link").prop("checked");
                if(bool) {
                    $("#youtube_link_wrapper").show();
                    $("#video_wrapper").hide();
                    $("#youtube_link").rules('add', {
                        required: true,
                    });
                    $("[name='video']").rules('remove');
                } else {
                    $("#youtube_link_wrapper").hide();
                    $("#video_wrapper").show();
                    $("#youtube_link").rules('remove');
                    $("[name='video']").rules('add', {
                        required: true
                    });
                }
            }

            /* $("#myform").on("submit", function(){
                const text = {};
                @foreach (config('translatable.locales') as $locale)
                    text["{{$locale}}"] = tinymce.get("text_{{$locale}}").getContent();
                @endforeach
                $ajax({
                    type: "POST",
                    
                });
                // @foreach (config('translatable.locales') as $locale)
                //     text["{{$locale}}"] = tinymce.get("text_{{$locale}}").getContent();
                // @endforeach
                // const json = JSON.stringify(text)
                // $("#text").val(json);
                //console.log(json);
                //return false;
            }); */
        </script>
    @endpush
</x-admin.layout.app>
