@extends('layouts.home')
@section('content')
<div class="background">
    <div class="Add">
        <div>
            <p>Product Review</p>
        </div>
        <div>

        </div>
    </div>
    <div class="Table">
        <table>
            <tr>
                <th>Name</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
                @foreach ($productReview as $row)
                    <tr>
                        <td>{{ $row->Name }}</td>
                        <td>{{ $row->NameProduct }}</td>
                        <td>{{ $row->Evaluate }}</td>
                        @if ($row->Status==1)
                            <td>Enabled</td>
                        @else
                            <td>Disenabled</td>
                        @endif
                        <td>
                            <div style="display:flex;justify-content:space-evenly">
                                <div><a href="productReview/{{ $row->IdReview }}/edit"><i class="fa-solid fa-pencil"></i></a></div>
                                <div><a href=""><i class="fa-solid fa-trash"></i></a></div>
                            </div>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection