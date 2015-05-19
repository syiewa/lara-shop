<ol class="dd-list">
    @foreach($pages as $page)
    <li class="dd-item" data-id="{{$page['id']}}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">{{$page['page_name']}}
            <button class="btn btn-xs btn-danger pull-right " id="delete" data-id="{{$page['id']}}">Delete</button> 
            <a class="btn btn-xs btn-primary pull-right" href="{{route('backend.page.edit',[$page['id'],'position' => $page['page_position']])}}">Edit</a>
        </div>
        @if($page['children'])
        <ol class="dd-list">
            @foreach($page['children'] as $child)
            <li class="dd-item" data-id="{{$child['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">{{$child['page_name']}}
                    <button class="btn btn-xs btn-danger pull-right" id="delete" data-id="{{$child['id']}}">Delete</button> 
                    <a class="btn btn-xs btn-primary pull-right" href="{{route('backend.page.edit',[$child['id'],'position' => $child['page_position']])}}">Edit</a>
                </div>
            </li>
            @endforeach
        </ol>
        @endif
    </li>
    @endforeach
</ol>