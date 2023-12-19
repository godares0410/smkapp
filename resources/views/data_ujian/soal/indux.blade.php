@php
$counter = 1
@endphp

@foreach ($soal as $data)


    <h3>{{$counter++}}. {{ $data->soal }} </h3>
    <p> A. {{ $data->pil_a }} </p>
    <p> B. {{ $data->pil_b }} </p>
    <p> C. {{ $data->pil_c }} </p>
    <p> D. {{ $data->pil_d }} </p>
    <p> E. {{ $data->pil_e }} </p>
    <br>
    <p> Kunci : {{ $data->jawaban }} </p>
@endforeach