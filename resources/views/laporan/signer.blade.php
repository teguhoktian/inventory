<div style="margin-top: 50px;">
    @if(count($signer['atasan_dari_atasan']) === 0)
    <table style="width: 100%; border: none; text-align: center;">
        <tr>
            <td style="width: 50%; vertical-align: top;"></td>
            <td style="width: 50%; vertical-align: top;">
                {{ __('Cirebon') }}, {{ date('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <p>Mengetahui,</p>
                <p><strong>{{ $signer['atasan'][0]['position'] }}</strong></p>
                <br><br><br> <!-- Ruang untuk tanda tangan -->
                <p>________________________</p>
                <p><em>{{ $signer['atasan'][0]['name'] }}</em></p>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <p>{{ __('Dibuat oleh') }},</p>
                <p><strong>{{ $signer['user']['position'] }}</strong></p>
                <br><br><br> <!-- Ruang untuk tanda tangan -->
                <p>________________________</p>
                <p><em>{{ $signer['user']['name'] }}</em></p>
            </td>
        </tr>
    </table>
    @else
    <table style="width: 100%; border: none; text-align: center;">
        <tr>
            <td style="width: 33%; vertical-align: top;"></td>
            <td style="width: 33%; vertical-align: top;"></td>
            <td style="width: 33%; vertical-align: top;">
                {{ __('Cirebon') }}, {{ date('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="width: 33%; vertical-align: top;">
                <p>Mengetahui,</p>
                <p><strong>{{ $signer['atasan_dari_atasan'][0]['position'] }}</strong></p>
                <br><br><br> <!-- Ruang untuk tanda tangan -->
                <p>________________________</p>
                <p><em>{{ $signer['atasan_dari_atasan'][0]['name'] }}</em></p>
            </td>
            <td style="width: 33%; vertical-align: top;">
                <p>Diperiksa oleh,</p>
                <p><strong>{{ $signer['atasan'][0]['position'] }}</strong></p>
                <br><br><br> <!-- Ruang untuk tanda tangan -->
                <p>________________________</p>
                <p><em>{{ $signer['atasan'][0]['name'] }}</em></p>
            </td>
            <td style="width: 33%; vertical-align: top;">
                <p>{{ __('Dibuat oleh') }},</p>
                <p><strong>{{ $signer['user']['position'] }}</strong></p>
                <br><br><br> <!-- Ruang untuk tanda tangan -->
                <p>________________________</p>
                <p><em>{{ $signer['user']['name'] }}</em></p>
            </td>
        </tr>
    </table>
    @endif
</div>