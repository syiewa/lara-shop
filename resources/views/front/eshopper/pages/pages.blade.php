@extends('front.eshopper.layouts.index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('main')
<div class="row">    		
    <div class="col-sm-12">    			   			
        <h2 class="title text-center">{{$page->page_name}}</h2>    	
        <div class="col-sm-12">
            <p>
                {!!str_replace(array("\r\n", "\n", "\r"),'<br />',$page->page_content)!!}
            </p>
        </div>
    </div>			 		
</div> 

@stop

