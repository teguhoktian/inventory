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
        {!! html()->form('POST', route('stok-awal.addtocart'))
        ->class('form-horizontal')
        ->open() !!}

        <tr style="background-color: #fcf4f4;;">
            <td width="1">
                <strong>#</strong>
            </td>
            <td width="240">
                {!! html()->select('id_barang', $barang)
                ->placeholder('Pilih')
                ->id('barang')
                ->class('form-control') !!}

                @error('id_barang')
                <span class="has-error text-sm text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="80">
                <input name="quantity" id="qty" type="number" min="0" class="form-control" />
                @error('quantity')
                <span class="has-error text-sm text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="120">
                <input name="harga" id="hargaBeli" type="number" min="0" class="form-control" />
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
                <button id="addtocart" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
        {{ html()->form()->close() }}
    </tbody>
    <tbody>
        @php
        $total_harga = 0;
        $counter = 0;
        @endphp
        @foreach($cart as $key => $product)
        @php
        $counter++;
        $total_harga += $product['harga'] * $product['quantity'];
        @endphp
        <tr>
            <td>{{ $counter }}</td>
            <td>
                {{$product['nama']}}
                <p><small class="help-block">{{$product['jenis']}}</small></p>
            </td>
            <td>{{$product['quantity']}} {{$product['satuan']}}</td>
            <td>{{
                number_format($product['harga'], 2, ".")
                }}</td>
            <td>
                {{
                number_format($product['harga'] * $product['quantity'], 2, ".")
                }}</td>
            <td>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete-form-{{$key}}').submit();">
                    <i class="fa fa-times"></i>
                </button>

                {!! html()->form('DELETE', route('stok-awal.removecartitem', $key))
                ->attribute('id', 'delete-form-'.$key)
                ->class('form-horizontal')
                ->attribute('style', 'display:inline')
                ->acceptsFiles()
                ->open() !!}
                {{ html()->form()->close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
    @if($total_harga > 0)
    <tfoot>
        <tr>
            <th></th>
            <th>{{ __('TOTAL') }}</th>
            <th></th>
            <th></th>
            <th>
                {{
                number_format($total_harga, 2, ".")

                }}
            </th>
            <th></th>
        </tr>
    </tfoot>
    @endif
</table>