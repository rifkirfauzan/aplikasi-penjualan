@extends('layout.app')
@section('title','Halaman Laporan')
@section('content')

<div id="app">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
</div>
<div class="card-body">
                <div class="nav">
                    <!-- <button class="btn btn-sm btn-primary"  v-on:click="#"><i class="fas fa-magnifier me-2"></i>Urutkan nama barang</a> -->
                    <!-- &nbsp; -->
                    <!-- <button class="btn btn-sm btn-primary" v-on:click="#"><i class="fas fa-magnifier me-2"></i>Urutkan tanggal transaksi</a> -->
                </div>
            <br>
            <div class="table-responsive">
<table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Jumlah terjual</th>
            <th>Tanggal transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $result->number_of_sellers }}</td> 
                <td>{{ $result->date_of_transaction }}</td> 
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->
@endsection
   
@section('pagescript')
<script>
    const App = {
        methods: {
            deleteData(id){
                let self = this;
                Swal.fire({
                    title: 'Are you sure want to delete?',
                    text: "Warning, you cannot restore deleted data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return axios.delete(`/stock/${id}`).then((res) => {
                            // console.log('Deleted');
                     
                        }).catch(err => {
                            Swal.fire({
                                title:'Error',
                                text: 'Data Not Delete',
                                icon: 'error',
                            })
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Your data has been deleted!.',
                        'success'
                        )
                    }
                    window.location.reload()
                })
            }  
        },
    }
    
    Vue.createApp(App).mount('#app')
</script>   



@endsection