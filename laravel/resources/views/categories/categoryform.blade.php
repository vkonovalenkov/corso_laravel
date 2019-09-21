<?php
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 19/09/2019
 * Time: 12:53
 */
?>
<div class="row">
    <div class="col-md-11 mt-2">
<form class="form-inline" action="{{!$category->category_name ? route('categories.store'): route('categories.update',$category->id)}}" method="POST">
    {{csrf_field()}}
    {{$category->category_name ? method_field('PATCH') : ''}}
    <div class="form-group">
        <input value="{{$category->category_name}}" name="category_name" id="category_name" class="form-control" required>
    </div>
    <div class="form-group col-md-2">
        <button class="btn btn-primary" title="SAVE"><span class="fa fa-save"></span></button>
    </div>
</form>
    </div>
@if($category->category_name)
    <div class="col-md-2">
<form class="form-inline" method="post" action="{{route('categories.destroy',$category->id)}}">
    {{method_field('DELETE')}}
    {{csrf_field()}}
    <button class="btn btn-danger" title="DELETE"><span class="fa fa-minus"></span></button>
</form>
    </div>
@endif
</div>
