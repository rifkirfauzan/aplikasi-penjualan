@extends('layout.app')
@section('title','Halaman edit product')
@section('content')
                        <div class="row" id="app">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Data product</h4>
                                        <p class="card-description">
                                    Ini halaman untuk menginput data
                                </p>
                            <form @submit.prevent="updateData">
                        @csrf
                        <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="name" id="name" v-model="name" placeholder="Masukan nama barang" class="form-control">
                        </div>
                        <div class="form-group">
                                <label>Jenis Barang</label>
                                <input type="text" name="type" id="type" v-model="type" placeholder="Masukan jenis barang..." class="form-control">
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
                        name: "{{ $product->name }}",
                        type: "{{ $product->type }}",
                    }
            },
            methods: {
                updateData(){
                    let self = this;
                    axios.patch(`http://localhost:8000/api/product/{{ $product->id }}`, {
                        name: self.name,
                        type: self.type,
                    }).then((res) => {
                        Swal.fire({
                            title:'Updated',
                            text: 'Data Has Been Updated',
                            icon: 'info',
                        })
                        window.location.href="/product"
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