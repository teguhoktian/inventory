<table class="table table-bordered ">
    <thead>
        <tr>
            <th>{{ __('No.') }}</th>
            <th>{{ __('Nama Barang') }}</th>
            <th>{{ __('Qty') }}</th>
            <th>{{ __('Harga') }}</th>
            <th>{{ __('Total') }}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {{
        Form::open(
        [
        'route' => 'barang-keluar.addtocart'
        ]
        )}}
        <tr style="background-color: #fcf4f4;;">
            <td width="1">
                <strong>#</strong>
            </td>
            <td width="240">
                {{ Form::select('id_barang', $barang, null, ['placeholder' => 'Pilih ', 'id' =>'barang',
                'class' =>'form-control'
                ]) }}
                @error('id_barang')
                <span class="has-error text-sm text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="80">
                <input name="quantity" id="qty" type="number" min="1" class="form-control"
                    value="{{ old('quantity')}}" />
                @error('quantity')
                <span class="has-error text-sm text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="120">
                <input name="harga" id="hargaBeli" type="number" class="form-control" value="{{ old('harga')}}" />
                @error('harga')
                <span class="has-error text-sm text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="120">
                <input class="form-control" id="totalHarga" value="0" disabled />
            </td>
            <td width="1">
                <button id="addtocart" class="btn btn-success">Add</button>
            </td>
        </tr>
        {{Form::close()}}
    </tbody>
    <tbody>
        @php
        $total_harga = 0
        @endphp
        @foreach($cart as $key => $product)
        @php
        $total_harga += $product['harga'] * $product['quantity'];
        @endphp
        <tr>
            <td>
                #
            </td>
            <td>
                {{$product['nama']}}
            </td>
            <td>
                {{$product['quantity']}} {{$product['satuan']}}
            </td>
            <td>{{
                number_format($product['harga'], 2, ".")
                }}</td>
            <td>
                {{
                number_format($product['harga'] * $product['quantity'], 2, ".")
                }}</td>
            <td>
                <button class="btn btn-danger" onclick="document.getElementById('delete-form-{{$key}}').submit();">
                    {{ __('Delete') }}
                </button>
                {!! Form::open([
                'id' => 'delete-form-'.$key,
                'method' => 'DELETE',
                'route' => ['barang-keluar.removecartitem', $key],'style'=>'display:inline'])
                !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
    @if($total_harga > 0)
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                {{
                number_format($total_harga, 2, ".")

                }}
            </td>
            <td></td>
        </tr>
    </tfoot>
    @endif
</table>