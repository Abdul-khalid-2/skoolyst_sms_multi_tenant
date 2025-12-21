@props([
    'title',
    'subtitle' => null,
    'action' => null,
    'actionLabel' => null,
    'actionRoute' => null,
    'actionIcon' => null,
    'breadcrumbs' => []
])

<div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <h4 class="mb-3">{{ $title }}</h4>
        @if($subtitle)
            <p class="mb-0">{{ $subtitle }}</p>
        @endif
        
        @if(!empty($breadcrumbs))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $crumb)
                        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                            @if(!$loop->last && isset($crumb['url']))
                                <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                            @else
                                {{ $crumb['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>
    
    @if($action && $actionLabel)
        <div>
            <a href="{{ $actionRoute ?? '#' }}" class="btn btn-primary add-list">
                @if($actionIcon)
                    <i class="{{ $actionIcon }} mr-3"></i>
                @endif
                {{ $actionLabel }}
            </a>
        </div>
    @endif
</div>