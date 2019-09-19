<?php
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 19/09/2019
 * Time: 12:53
 */
?>

<form action="{{!$category->category_name ? route('categories.store'): route('categories.update',$category->id)}}" method="POST">
    {{csrf_field()}}
    {{$category->category_name ? method_field('PATCH') : ''}}
    <div class="form-group">
        <label for="category_name">Category name</label>
        <input value="{{$category->category_name}}" name="category_name" id="category_name" class="form-control" required>
    </div>
    <div class="form-group col-8">
        <button class="btn btn-primary">SAVE</button>
    </div>
</form>
