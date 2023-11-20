<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        x-data="async () => {
            @if($hasCss())
            if(!document.getElementById('map-picker-css')){
                const link  = document.createElement('link');
                link.id   = 'map-picker-css';
                link.rel  = 'stylesheet';
                link.type = 'text/css';
                link.href = '{{ $cssUrl() }}';
                link.media = 'all';
                document.head.appendChild(link);
            }
            @endif
        @if($hasJs())
            if(!document.getElementById('map-picker-js')){
                const script = document.createElement('script');
                script.id   = 'map-picker-js';
                script.src = '{{ $jsUrl() }}';
                document.head.appendChild(script);
            }
            @endif
            do {
                await (new Promise(resolve => setTimeout(resolve, 100)));
            } while (window.mapPicker === undefined);
            const m = mapPicker($wire, {{ $getMapConfig()}});
            m.attach($refs.map);
        }"
        wire:ignore>
        <div
            x-ref="map"
            class="w-full" style="min-height: 30vh; z-index: 1 !important;">
        </div>
    </div>
    {{--    x-data="setTimeout(()=>{c=mapPicker($wire, {{ $getMapConfig()}});c.attach($refs.map)}, 500)"--}}
    {{--    @map-script-loaded.window="() => {c = mapPicker($wire, {{ $getMapConfig()}}); c.attach($refs.map)}">--}}
    {{--    <div--}}
    {{--        x-data="() => {window.addEventListener('load', (event) => {$el.children[0].removeAttribute('x-ignore');console.log('page is fully loaded', $el.children[0]);});}">--}}
    {{--        <div--}}
    {{--            wire:ignore--}}
    {{--            x-ignore--}}
    {{--            style="z-index: 1"--}}
    {{--            x-data="mapPicker({{ $getMapConfig()}})"--}}
    {{--            x-init="attach($el)">--}}
    {{--            <div--}}
    {{--                x-ref="map"--}}
    {{--                class="w-full" style="min-height: 30vh">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</x-dynamic-component>
