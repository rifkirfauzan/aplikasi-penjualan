@extends('layout.app')
@section('title','Halaman edit stok')
@section('content')
                        <div class="row" id="app">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Data Stock</h4>
                                        <p class="card-description">
                                    Ini halaman untuk menginput data
                                </p>
                            <form @submit.prevent="updateData">
                        @csrf
                        <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="stocks" id="stocks" v-model="stocks" placeholder="Masukan jumlah stok..." class="form-control">
                        </div>
                        <div class="form-group">
                                <label>Jumlah Terjual</label>
                            <input type="number" name="number_of_sellers" id="number_of_sellers" v-model="number_of_sellers" placeholder="Masukan jumlah terjual..." class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Nama Barang </label>
                                <select  class="form-control select2" style="width: 100%;" name="name" id="name" v-model="name">
                                    <option value>-- Pilih nama barang: --</option>
                                    @foreach ( $products as $product )
                                    <option value="{{ $product->name }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Jenis Barang </label>
                                <select  class="form-control select2" style="width: 100%;" name="type" id="type" v-model="type">
                                    <option value>-- Pilih Jenis barang: --</option>
                                    @foreach ( $products as $product )
                                    <option value="{{ $product->type }}">{{ $product->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Tanggal Transaksi </label>
                                <select  class="form-control select2" style="width: 100%;" name="date_of_transaction" id="date_of_transaction" v-model="date_of_transaction">
                                    <option value>-- Pilih Tanggal Transaksi: --</option>
                                    @foreach ( $transactions as $transaction )
                                    <option value="{{ $transaction->date_of_transaction }}">{{ $transaction->date_of_transaction }}</option>
                                @endforeach
                            </select>
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
                        stocks:"{{ $stock->stocks }}",
                        number_of_sellers: "{{ $stock->number_of_sellers }}",
                        name: "{{ $stock->name }}",
                        type: "{{ $stock->type }}",
                        date_of_transaction: "{{ $stock->date_of_transaction }}",
                    }
            },
            methods: {
                updateData(){
                    let self = this;
                    axios.patch(`http://localhost:8000/api/stock/{{ $stock->id }}`, {
                        stocks: self.stocks, 
                        number_of_sellers: self.number_of_sellers,
                        name: self.name,
                        type: self.type,
                        date_of_transaction: self.date_of_transaction,
                    }).then((res) => {
                        Swal.fire({
                            title:'Updated',
                            text: 'Data Has Been Updated',
                            icon: 'info',
                        })
                        window.location.href="/stock"
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