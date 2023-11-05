@extends('layouts.admin')
@push('styles')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        input.form-control.is-invalid:focus{
            /* background-color: red; */
            box-shadow: none;
            border: 1px solid #ff887d;
        }
        /* table tbody tr td:last-child{
            width: 180px;
        } */
    </style>
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title ?? 'N' }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-12 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title ?? 'n' }}</h6>
                </div>
                <div class="card-body">
                    {{-- @dump($data) --}}
                    {{-- <a href="" class="btn btn-md btn-primary mb-3" id="btnTambahUser" data-toggle="modal" data-target="#modalUser"><i
                            class="fas fa-fw fa-plus"></i> Add User</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTUsers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    {{-- <th>Product ID</th>
                                    <th>Total Quantity</th>
                                    <th>Total Price</th>
                                    <th>Transaction Created</th> --}}
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Bank Account</th>
                                    {{-- <th>Total Quantity</th>
                                    <th>Total Price</th> --}}
                                    <th>Total Payouts</th>
                                    <th>Last Payouts</th>
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

    <!-- CRUD Modal User -->
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Modal User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCreateUser">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="cth: Adinda Maharani" required>
                            <span class="text-danger" id="name-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="cth: adminkeren" required>
                            <span class="text-danger" id="username-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="cth: mailmu@gmail.com" required>
                            <span class="text-danger" id="email-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <small><i>(default: writer)</i></small></label>
                            <select class="form-control" name="role" id="role">
                                <option data-name="writer" value="writer">Writer</option>
                                <option data-name="admin" value="admin">Admin</option>
                                <option data-name="super" value="super">Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                            <span class="text-danger" id="password-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password_conf" class="form-label">Password Konfirmasi</label>
                            <input type="password" class="form-control" name="password_conf" id="password_conf" placeholder="" required>
                            <span class="text-danger" id="passwordconf-error"></span>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanUser"><i class="fas fa-fw fa-save"></i>Simpan</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>
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
        $(document).ready(function(){
            $('body').on('click', '#btnAddPayout', (e) => {
                e.preventDefault();
                const {user,payout} = e.target.dataset
                $.ajax({
                    url: "{{ route('admin-settlement.store') }}",
                    method: 'POST',
                    data:{
                        _token: '{{ csrf_token() }}',
                        user_id: user,
                        amount: parseInt(payout),
                    },
                    success: (res) => {
                        console.log(res);
                        Swal.fire({
                            type: res.type,
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 2500,
                        });
                        $('#DTUsers').DataTable().draw()
                    },
                    error: (res) => {
                        console.log(res);
                    },
                })
            })
        })
        /* INISIALISASI DATATABLE */
        $('#DTUsers').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin-payout.getpayouts') }}",
              cache: true,
              columns: [
                  {data: 'DT_RowIndex', name: 'id', orderable: false},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'banks', name: 'banks'},
                  {data: 'total_payout', name: 'total_payout'},
                  {data: 'settlements', name: 'settlements.payout_date'},
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
