@extends('layouts.main')
@section('container')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="bg-white">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            @php
                                $days = [
                                    1,
                                    2,
                                    3,
                                    4,
                                    5,
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11,
                                    12,
                                    13,
                                    14,
                                    15,
                                    16,
                                    17,
                                    18,
                                    19,
                                    20,
                                    21,
                                    22,
                                    23,
                                    24,
                                    25,
                                    26,
                                    27,
                                    28,
                                    29,
                                    30,
                                    31,
                                ];
                            @endphp
                            @foreach ($days as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Januari</td>
                            <td><input type="checkbox" checked></td>
                            @php
                                $days = [
                                    1,
                                    2,
                                    3,
                                    4,
                                    5,
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11,
                                    12,
                                    13,
                                    14,
                                    15,
                                    16,
                                    17,
                                    18,
                                    19,
                                    20,
                                    21,
                                    22,
                                    23,
                                    24,
                                    25,
                                    26,
                                    27,
                                    28,
                                    29,
                                    30,
                                    31,
                                ];
                            @endphp
                            @foreach ($days as $day)
                                <td><input type="checkbox" checked></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Februari</td>
                            <td><input type="checkbox" checked></td>
                            @php
                                $days = [
                                    1,
                                    2,
                                    3,
                                    4,
                                    5,
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11,
                                    12,
                                    13,
                                    14,
                                    15,
                                    16,
                                    17,
                                    18,
                                    19,
                                    20,
                                    21,
                                    22,
                                    23,
                                    24,
                                    25,
                                    26,
                                    27,
                                    28,
                                    29,
                                    30,
                                    31,
                                ];
                            @endphp
                            @foreach ($days as $day)
                                <td><input type="checkbox" checked></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
