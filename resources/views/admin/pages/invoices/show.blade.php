@extends('admin.layouts.master')

@section('content')
<table class="table" border="1">
    <tr>
        <th>invoice_id</th>
        <th>user</th>
        <th>status</th>
    </tr>

    <tr>
        <td>{{$invoice->invoice_id}}</td>
        <td>{{$invoice->user->name}}</td>

        @if ($invoice->status == 1)
            <td>paid</td>
        @else
            <td>failed</td>
        @endif
    </tr>
</table>
@endsection