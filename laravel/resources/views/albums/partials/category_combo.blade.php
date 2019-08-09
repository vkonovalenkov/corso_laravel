<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 08/08/2019
 * Time: 17:09
 */
?>
<div class="form-group">
            <label for="categories">Categories</label>
    <select class="form-control" name="categories[]" id="categories" multiple size="5">
    @foreach($categories as $category)
        <option {{in_array($category->id,$selectedCategories) ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
    </select>
</div>

