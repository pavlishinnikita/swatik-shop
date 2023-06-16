<style>
    table.column-table, table.column-table td, table.column-table th {
        border: 1px solid black;
        text-align: center;
        vertical-align: middle;
    }

    table.column-table {
        border-collapse: collapse;
        width: 100%;
    }
</style>
<table class="column-table">
    <thead>
        <tr>
            @foreach(is_array($value) ? $value : [] as $headerKey => $bodyValue)
                <th>{{$headerKey}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach(is_array($value) ? $value : [] as $headerKey => $bodyValue)
                <td>{{$bodyValue}}</td>
            @endforeach
        </tr>
    </tbody>
</table>
