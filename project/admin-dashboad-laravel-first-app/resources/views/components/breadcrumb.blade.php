<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach($breadcrumbs as $index => $item)
                        <li class="breadcrumb-item {{ $index === count($breadcrumbs) - 1 ? 'active' : '' }}">
                            @if($item['url'])
                                <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

