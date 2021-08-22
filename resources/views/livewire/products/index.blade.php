
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Product</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <select wire:model="paginate" name="" id="" class="form-controller form-controller-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0 ;
                            @endphp
                            @foreach ($tes as $data)
                            @php
                                $no++
                            @endphp
                            <tr>
                                <th scope="row">{{$no}}</th>
                                <td>{{$data->title}}</td>
                                {{-- <td>{{$data->description}}</td> --}}
                                <td>@currency($data->price)</td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $tes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
