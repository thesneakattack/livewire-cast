<div>
    @foreach ($story->lflbAssets->sortBy('pivot.position') as $asset)
    <div>
        <h2>{{$asset->pivot->position}}</h2>
        <h3>{{$asset->type}}</h3>
        @switch($asset->type)
        @case('TEXT')
        {{$asset->cleanText}}
        @break

        @case('IMAGE')
        {{-- <img src="{{ asset('/storage/'.$asset->originalImage) }}" alt=""> --}}
        <img src="{{ 'https://lflbsign.webfoundry.dev/assets/'.$asset->originalImage }}" alt="">
        {{-- {{$asset->originalImage}} --}}
        @break
        @default
        ASSET
        @endswitch
    </div>
    @endforeach
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
