<?php
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 19/09/2019
 * Time: 12:58
 */
?>
@extends('templates.default')
@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Manage categories</h2>
        @include('categories.categoryform')
    </div>
</div>
@endsection
