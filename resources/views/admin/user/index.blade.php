@extends('layouts.admin')
@push('styles')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        input.form-control.is-invalid:focus{
            box-shadow: none;
            border: 1px solid #ff887d;
        }
    </style>
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-12 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-md btn-primary mb-3" id="btnTambahUser" data-toggle="modal" data-target="#modalUser"><i
                            class="fas fa-fw fa-plus"></i> Add User</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTUsers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script src="{{ url('sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('sb-admin') }}/js/demo/datatables-demo.js"></script>

    <script>

        /* INISIALISASI DATATABLE */
        $('#DTUsers').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin-user.getusers') }}",
              cache: true,
              columns: [
                  {data: 'DT_RowIndex', name: 'id', orderable: false},
                  {data: 'photo', name: 'photo'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'phone', name: 'phone'},
                  {data: 'updated_at', name: 'created_at'},
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: false, 
                      searchable: false
                  },
              ],
              "language": {
                    "processing": "<div class=\"spinner-border bg-transparent\" role=\"status\"></div>"
                }
        });
    </script>
@endpush
