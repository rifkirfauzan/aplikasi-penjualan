@extends('layout.app')
@section('title','Halaman stok')
@section('content')

<div id="app">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Stock</h6>
</div>
<div class="card-body">
          <div class="nav-link">
                    <a class="btn btn-sm btn-primary" href="/stock/create" role="button"><i class="fas fa-plus me-2"></i> Add stock data</a>
                </div>
                <div class="nav">
                    <!-- <button class="btn btn-sm btn-primary"  v-on:click="#"><i class="fas fa-magnifier me-2"></i>Urutkan nama barang</a> -->
                    <!-- &nbsp; -->
                    <!-- <button class="btn btn-sm btn-primary" v-on:click="#"><i class="fas fa-magnifier me-2"></i>Urutkan tanggal transaksi</a> -->
                </div>
            <br>
            <div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Stock</th>
            <th>Jumlah terjual</th>
            <th>Nama Barang</th>
            <th>Jenis barang</th>
            <th>Tanggal transaksi</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
            <td>{{ $stock->stocks }}</td>
            <td>{{ $stock->number_of_sellers }}</td>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->type }}</td>
            <td>{{ $stock->date_of_transaction }}</td>
            <td>
            <a href="/stock/edit/{{$stock->id}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> |
            <button class="btn btn-sm btn-danger" @click="deleteData({{ $stock->id }})"><i class="fas fa-trash-alt"></i></button>
            </td>
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
                        return axios.delete(`http://localhost:8000/api/stock/${id}`).then((res) => {
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