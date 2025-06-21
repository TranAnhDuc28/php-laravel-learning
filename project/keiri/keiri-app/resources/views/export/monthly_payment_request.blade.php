<table>
    @for($i = 1; $i <= 12; $i++)
        <tr></tr>
    @endfor

    {{--  Header table  --}}
    <tr>
        <td></td>
        <td>{{ __('要員名') }}</td>
        <td>{{ __('ランク') }}</td>
        <td>{{ __('区分') }}</td>
        <td>{{ __('契約単金(上段：月額、下段：時間単価）') }}</td>
        <td>{{ __('時間外稼働') }}</td>
        <td>{{ __('業務内容') }}</td>
        <td colspan="3">{{ __('計') }}</td>
    </tr>
    @foreach($data as $item)
        <tr>
            <td></td>
            <td rowspan="2">{{ $item['employee_name'] }}</td>
            <td rowspan="2">{{ $item['rank'] }}</td>
            <td>{{ __('月額単金') }}</td>
            <td >{{ $item['contract_unit_price'] }}</td>
            <td rowspan="2">{{ $item['monthly_data']['overtime_work'] }}</td>
            <td rowspan="2">{{ implode(', ', $item['job_content']) }}</td>
            <td colspan="3" rowspan="2">{{ $item['monthly_data']['total'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{ __('普通残業') }}</td>
            <td>{{ $item['monthly_data']['regular_overtime'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td colspan="6">{{ __('小計') }}</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{ __('その他ご請求経費') }}</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">{{ __('合計請求額') }}</td>
        <td colspan="3"></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Takeshi Kashiwagi</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>BIP SYSTEMS VIETNAM CO.,LTD</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr></tr>
</table>
