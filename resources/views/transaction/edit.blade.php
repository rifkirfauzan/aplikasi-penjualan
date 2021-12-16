@extends('layout.app')
@section('title','Halaman edit transaction')
@section('content')
                        <div class="row" id="app">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Data transaction</h4>
                                        <p class="card-description">
                                    Ini halaman untuk menginput data
                                </p>
                            <form @submit.prevent="updateData">
                        @csrf
                        <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="text" name="date_of_transaction" id="date_of_transaction" v-model="date_of_transaction" placeholder="Masukan Tanggal Transaksi..." class="form-control">
                        </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagescript')
<script>
    const App = {
            data() {            
                    return {
                        date_of_transaction: "{{ $transaction->date_of_transaction }}",
                    }
            },
            methods: {
                updateData(){
                    let self = this;
                    axios.patch(`http://localhost:8000/api/transaction/{{ $transaction->id }}`, {
                        date_of_transaction: self.date_of_transaction,
                    }).then((res) => {
                        Swal.fire({
                            title:'Updated',
                            text: 'Data Has Been Updated',
                            icon: 'info',
                        })
                        window.location.href="/transaction"
                    }).catch(err => {
                        Swal.fire({
                            title:'Error',
                            text: 'Data Not Updated',
                            icon: 'error',
                        })
                    })
                },
            }
    }

    Vue.createApp(App).mount('#app')
    </script>    
@endsection