<ol class="dd-list">
    @foreach($slideshow as $cat)
    <li class="dd-item" data-id="{{$cat->id}}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">{{$cat->ss_name}}
            <button class="btn btn-xs btn-danger pull-right " id="delete" data-id="{{$cat->id}}">Delete</button> 
            <a class="btn btn-xs btn-primary pull-right" href="{{route('backend.slideshow.edit',$cat->id)}}">Edit</a>
        </div>
    </li>
    @endforeach
</ol>