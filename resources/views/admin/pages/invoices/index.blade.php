@extends('admin.layouts.master')

@section('content')
<h1>all invoices</h1>
<table class="table" border="1">
    <tr>
        <th>#</th>
        <th>invoice id</th>
        <th>user</th>
        <th>details</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    @foreach ($invoices as $invoice)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$invoice->invoice_id}}</td>
        <td>{{$invoice->user->name}}</td>
        <td><a href="{{route('invoices.show',$invoice->invoice_id)}}">show details</a></td>
        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                data-bs-target="#editexampleModal{{$invoice->id}}">
                edit
            </button>
        </td>
        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                data-bs-target="#deleteexampleModal{{$invoice->id}}">
                delete
            </button>

        </td>
    </tr>

    <!-- Modal -->
    <div class="modal fade" id="editexampleModal{{$invoice->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit invoice</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('invoices.update',$invoice->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="">edit invoice id</label>
                        <input type="text" name="invoice_id" value="{{$invoice->invoice_id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteexampleModal{{$invoice->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('invoices.destroy',$invoice->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <h5>are you sure you want to delete this invoice?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</table>
@endsection