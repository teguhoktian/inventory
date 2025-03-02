<table class="table table-bordered">
    <thead>
        <tr class="bg-light-blue">
            <th>{{ __('No.') }}</th>
            <th>{{ __('Kode Barang') }}</th>
            <th>{{ __('Nama Barang') }}</th>
            <th>{{ __('Satuan') }}</th>
            <th>{{ __('Qty') }}</th>
            <th>{{ __('Harga') }}</th>
            <th>{{ __('Total') }}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {!! html()->form('POST', route('barang-masuk.addtocart'))
        ->attribute('id', '')
        ->class('add-to-cart-form')
        ->open() !!}
        <tr class="bg-warning">
            <td width="1">
                <strong>#</strong>
            </td>
            <td width="190px">
                <div class="input-group">
                    <input type="text" class="form-control" name="kode_barang" id="kodebaranginput">
                    <div class="input-group-addon" style="cursor: pointer;" data-toggle="modal"
                        data-target="#modal-list-barang">
                        <i class="fa fa-search"></i>
                    </div>
                </div>

                @error('id_barang')
                <span class="text-danger small" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td>
                <input name="nama_barang" disabled id="nama_barang" class="form-control" aria-label="Nama Barang" />
            </td>
            <td width="90px">
                <input name="satuan" id="satuan" disabled class="form-control" aria-label="Satuan" />
            </td>
            <td class="" width="100px">
                <input name="quantity" id="qty" type="number" min="0" class="form-control" aria-label="Quantity" />
                @error('quantity')
                <span class="text-danger small" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="150px">
                <input name="harga" id="hargaBeli" type="number" min="0" class="form-control" aria-label="Harga" />
                @error('harga')
                <span class="text-danger small" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </td>
            <td width="150px">
                <input class="form-control" id="totalHarga" value="0" disabled aria-label="Total Harga" />
            </td>
            <td width="1px">
                <button id="addtocart" class="btn btn-success" type="submit">
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
            <td>{{ e($product['kode_barang']) }} </td>
            <td>
                {{ e($product['nama']) }} -
                <span class="text-muted small">{{ e($product['jenis']) }}</span>
            </td>
            <td>{{ e($product['satuan']) }}</td>
            <td>{{ e($product['quantity']) }} </td>
            <td>{{ number_format($product['harga'], 2, '.', ',') }}</td>
            <td>{{ number_format($product['harga'] * $product['quantity'], 2, '.', ',') }}</td>
            <td>
                <button class="btn btn-danger" type="button" onclick="deleteItem({{ $key }})">
                    <i class="fa fa-times"></i>
                </button>
                {!! html()->form('DELETE', route('barang-masuk.removecartitem', $key))
                ->attribute('id', '')
                ->class('delete-form-' . $key)
                ->style('display: inline;')
                ->open() !!}
                {{ html()->form()->close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
    @if($total_harga > 0)
    <tfoot>
        <tr class="">
            <th></th>
            <th>{{ __('TOTAL') }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ number_format($total_harga, 2, '.', ',') }}</th>
            <th></th>
        </tr>
    </tfoot>
    @endif
</table>

<!-- Modal -->
<x-modal id="modal-list-barang" size="modal-lg" headerClass="bg-primary text-white">
    <x-slot name="header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('Daftar Barang') }}</h4>
    </x-slot>

    <x-slot name="body">
        <!-- Tabel DataBarang -->
        <table id="barangTable" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>{{ __('Kode Barang') }}</th>
                    <th>{{ __('Nama Barang') }}</th>
                    <th>{{ __('Satuan') }}</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTable rows akan dimuat melalui JavaScript -->
            </tbody>
        </table>
    </x-slot>

    <x-slot name="footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
            {{ __('Close') }}
        </button>
    </x-slot>
</x-modal>