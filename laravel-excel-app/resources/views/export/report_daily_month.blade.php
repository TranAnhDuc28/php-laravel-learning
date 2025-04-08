<table>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>

    {{--  Header table  --}}
    <tr>
        <td></td>
        <td>要員名</td>
        <td>ランク</td>
        <td>区分</td>
        <td>契約単金(上段：月額、下段：時間単価）</td>
        <td>時間外稼働</td>
        <td>業務内容</td>
        <td colspan="3">計</td>
    </tr>
    @foreach($data as $item)
        <tr>
            <td></td>
            <td rowspan="2">{{ $item['name'] }}</td>
            <td rowspan="2">{{ $item['rank'] }}</td>
            <td>月額単金</td>
            <td >{{ $item['monthly_price'] }}</td>
            <td rowspan="2">{{ $item['overtime'] }}</td>
            <td rowspan="2">{{ $item['description'] }}</td>
            <td colspan="3" rowspan="2">{{ $item['monthly_price'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td>普通残業</td>
            <td>{{ $item['hourly_price'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td colspan="6">小　　　　　　　　　　　　　計</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">その他ご請求経費</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="6">合　　計　　請　　求　　額</td>
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
