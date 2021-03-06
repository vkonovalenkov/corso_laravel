{{--
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 06/09/2019
 * Time: 18:04
 */
--}}

@extends('templates.default')

@section('content')
    @include('partials.inputerrors')
 <div class="row">
    <div class="col-8">
    <table class="table table-striped" id="categoryList">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Created date</th>
            <th>Update date</th>
            <th>Number of albums</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($categories as $categoryI)
            <tr id="tr-{{$categoryI->id}}">
                <td>{{$categoryI->id}}</td>
                <td id="catid-{{$categoryI->id}}">{{$categoryI->category_name}}</td>
                <td>{{$categoryI->created_at}}</td>
                <td>{{$categoryI->albums_count}}</td>
                <td>
                    <form class="form-inline" method="post" action="{{route('categories.destroy',$categoryI->id)}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button id="btnDelete-{{$categoryI->id}}" class="btn btn-danger" title="DELETE"><span class="fa fa-minus"></span></button>&nbsp;
                        <a id="upd-{{$categoryI->id}}" href="{{route('categories.edit',$categoryI->id)}}" class="btn btn-primary" title="UPDATE"><span class="fa fa-pen"></span></a>
                    </form>
                </td>
            </tr>
            @empty
            <tfoot>
                <tr>
                    <td colspan="5">No categories</td>
                </tr>
            </tfoot>
            @endforelse
    </table>
        <div class="row">
            <div class="col-md-8 order-first order-md-2">{{$categories->links('vendor.pagination.bootstrap-4')}}</div>
        </div>
     </div>
     <div class="col-4">
         <h2>Add New Category</h2>
         @include('categories.categoryform')
     </div>
 </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('form .btn-danger').on('click',function (evt) {
                evt.preventDefault();
                var f = this.parentNode;
                var categoryid =  this.id.replace('btnDelete-','')*1;

                var Trid = 'tr-'+categoryid;
                var urlCategory = f.action;
                console.log(urlCategory);
                //return false;
                //alert(urlCategory);
                $.ajax(
                    urlCategory,
                    {
                        data:{
                            '_token':Laravel.csrfToken
                        },
                        //method:"DELETE",
                        type: "DELETE",
                        complete: function (resp) {

                            var resp = JSON.parse(resp.responseText);
                            /*
                            //if (resp.responseText == 1) {
                            if (resp.success) {

                            } else {
                                alert('Problem contacting server');
                            }
                            */
                            alert(resp.message);
                            //$('#'+Trid).remove();
                            $('#'+Trid).fadeOut(2000);
                        }
                    }
                )
                return false;
            });
            //Add Category
            $('#manageCategoryForm .btn-primary').on('click',function (evt) {
                evt.preventDefault();
                var f = $('#manageCategoryForm');
                var data = f.serialize();
                var urlCategory = f.attr('action');
                //console.log(urlCategory);
                //return false;
                $.ajax(
                    urlCategory,
                    {
                        data:data,
                        //method:'POST',
                        type:'POST',
                        complete: function (resp) {

                            var resp = JSON.parse(resp.responseText);
                            f[0].reset();
                            f[0].category_name.value = '';
                            alert(resp.message);
                            //$('#'+Trid).remove();
                            $('#'+Trid).fadeOut(2000);
                        }
                    }
                )
                return false;
            });
            //Update Category
            $('#categoryList a.btn-primary').on('click',function (evt) {
                evt.preventDefault();
                var categoryId = this.id.replace('upd-','');
                var catRow = $('#tr-'+categoryId);
                $('#categoryList tr').css('border-color','trasparent');
                catRow.css('border','1px color red');
                var tdCat = $('#catid-'+categoryId);

                var categoryName = tdCat.text();
                var f = $('#manageCategoryForm');

                var urlUpdate = this.href.replace('/edit', '');
                f.attr('action', urlUpdate);

                f[0].category_name.value = categoryName;
                f[0].category_name.addEventListener('keyup', function(){
                   tdCat.html(f[0].category_name.value);
                });
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                input.value = 'PATCH';
                f[0].appendChild(input);
                console.log(f);
            });
        });
    </script>
    @endsection
