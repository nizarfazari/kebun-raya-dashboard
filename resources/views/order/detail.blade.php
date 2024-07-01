@extends('layouts.master')
@section('title', 'Laravel')

@section('content')
    <div class="section-header">
        <h1>Pesanan</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Invoices</h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>

        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                            <th>Due Date</th>
                            <th>No Resi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div>{{ $d->order_id_midtrans }}</div>
                                </td>
                                <td class="font-weight-600">{{ $d->transaction_buyer->first_name }}
                                    {{ $d->transaction_buyer->last_name }}</td>
                                <td>
                                    @if ($d->status == 'PENDING')
                                        <div class="badge badge-primary">PENDING</div>
                                    @elseif($d->status == 'SUDAH-DIBAYAR')
                                        <div class="badge badge-info">SUDAH DIBAYAR</div>
                                    @elseif($d->status == 'DIKIRIM')
                                        <div class="badge badge-warning">MENUNGGU DITERIMA</div>
                                    @elseif($d->status == 'DITERIMA')
                                        <div class="badge badge-success">DITERIMA</div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $d->total_biaya_product + $d->biaya_pengiriman }}</div>
                                </td>
                                <td>{{ $d->created_at }}</td>
                                <td>
                                    @if ($d->receipt)
                                        <p class="mb-0">{{ $d->receipt->no_receipt }}</p>
                                    @else
                                        <p>No Resi Belum Di inputkan</p>
                                    @endif

                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                    @if ($d->status == 'SUDAH-DIBAYAR')
                                        <a href="#" class="btn btn-primary" data-target="#modal-1"
                                            data-id="{{ $d->id }}" data-toggle="modal">Upload Resi</a>
                                        <button class="btn btn-primary swal-button-confirm"
                                            data-id="{{ $d->order_id_midtrans }}">Konfirmasi</button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        {{-- Modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-1">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="POST" enctype="multipart/form-data"
                    action="{{ route('order.upload_receipt') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="transaction-id" name="transaction_id">
                        <div class="form-group">
                            <label>Uplaod Bukti Resi</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label>No Resi</label>
                            <input type="text" class="form-control" name="no_receipt">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
@push('page-script')
    <script>
        $('#modal-1').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget); // Button yang membuka modal
            let transactionId = button.data('id'); // Ekstrak info dari atribut data-*
            console.log(transactionId)
            let modal = $(this);
            modal.find('.modal-body #transaction-id').val(transactionId);
        });

        function confirmStatus(orderId) {
            $.ajax({
                url: '/api/transaction/confirm',
                type: 'POST',
                data: {
                    order_id: orderId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    swal('Success!', response.message, 'success');
                    location.reload(); // Reload halaman setelah berhasil
                },
                error: function(response) {
                    swal('Error!', response.responseJSON.message, 'error');
                }
            });
        }


        // $("#swal-6").click(function() {
        //     swal({
        //             title: 'Are you sure?',
        //             text: 'Once deleted, you will not be able to recover this imaginary file!',
        //             icon: 'warning',
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 let button = $(this);
        //                 let orderId = button.data('id'); // Ekstrak info dari atribut data-*
        //                 console.log(orderId)
        //                 // confirmStatus(orderId); // Panggil fungsi untuk konfirmasi status
        //             } else {
        //                 swal('Your imaginary file is safe!');
        //             }
        //         });
        // });

        $(document).on("click", ".swal-button-confirm", function() {
            let button = $(this);
            let orderId = button.data('id');
            swal({
                    title: 'Are you sure?',
                    text: 'Do you want to confirm this order?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: false,
                })
                .then((willConfirm) => {
                    if (willConfirm) {
                        confirmStatus(orderId);
                    } else {
                        swal('Confirmation canceled!');
                    }
                });
        });
    </script>
@endpush
