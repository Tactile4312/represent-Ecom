@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6>
      <a href="{{route('category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($categories)>0)
        <form id="categoryForm" method="POST" action="{{ route('category.bulkDelete') }}">
          @csrf
          @method('DELETE')
          <table class="table table-bordered table-hover" id="banner-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" id="master"></th>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Is Parent</th>
                <th>Parent Category</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <td><input type="checkbox" class="sub_chk" data-id="{{ $category->id }}"></td>
                  <td>{{$category->id}}</td>
                  <td>{{$category->title}}</td>
                  <td>{{$category->slug}}</td>
                  <td>{{(($category->is_parent==1)? 'Yes': 'No')}}</td>
                  <td>{{$category->parent_info->title ?? ''}}</td>
                  <td>
                    @if($category->photo)
                      <img src="{{$category->photo}}" class="img-fluid" style="max-width:80px" alt="{{$category->photo}}">
                    @else
                      <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                    @endif
                  </td>
                  <td>
                    @if($category->status=='active')
                      <span class="badge badge-success">{{$category->status}}</span>
                    @else
                      <span class="badge badge-warning">{{$category->status}}</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm deleteSingle" data-id="{{ $category->id }}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <button class="btn btn-danger btn-sm" id="deleteAll" style="margin-top: 10px;">Delete Selected</button>
        </form>
        <span style="float:right">{{$categories->links()}}</span>
        @else
          <h6 class="text-center">No Categories found!!! Please create Category</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      $('#banner-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [0, 3, 4, 5, 8]
                }
            ]
        });

        // Sweet alert for single delete
        $('.deleteSingle').on('click', function(e) {
            var id = $(this).data('id');
            var form = $('#categoryForm');
            e.preventDefault();
            swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this data!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                     form.attr('action', '{{ route('category.destroy', '') }}/' + id);
                     form.submit();
                  } else {
                      swal("Your data is safe!");
                  }
              });
        });

        // Select all checkboxes
        $('#master').on('click', function(e) {
            if($(this).is(':checked', true)) {
               $(".sub_chk").prop('checked', true);
            } else {
               $(".sub_chk").prop('checked', false);
            }
        });

        // Sweet alert for bulk delete
        $('#deleteAll').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <= 0) {
                swal({
                    title: "Error!",
                    text: "Please select row.",
                    icon: "error",
                    timer: 2000,
                    buttons: false
                });
            } else {
                var form = $('#categoryForm');
                e.preventDefault();
                swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover this data!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                      if (willDelete) {
                         var join_selected_values = allVals.join(",");
                         form.append('<input type="hidden" name="ids" value="'+ join_selected_values +'" />');
                         form.submit();
                      } else {
                          swal("Your data is safe!");
                      }
                  });
            }
        });
  </script>
@endpush
