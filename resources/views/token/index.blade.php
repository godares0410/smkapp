@extends('layout.master')

@section('title')
    Token
@endsection

@section('token-active', 'active')

@section('badge')
    @parent
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="box">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body">
                    <div class="row">
                    {{-- <div class="col-lg-4"></div> --}}
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <p>Token Saat Ini</p>

                                    <h3>{{ $token }}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-key"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                     @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session('success') }}',
                                showConfirmButton: false,
                                timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                            });
                        </script>
                    @endif
                    <div class="row">
                        <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="generateToken()" style="margin-bottom: 10px">Acak Token</button><br>
                            <form class="btn btn-xs" action="{{ route('token.update') }}" method="POST">
                                @csrf
                                <input type="text" name="token" id="token"><br>
                                <button type="submit" class="btn btn-primary" style="margin-top: 15px">Masukkan Token</button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4"></div> --}}
                </div>
        </div>
        <!-- right col -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
<script>
    function generateToken() {
        // Function to generate a random string with the specified pattern
        function generateRandomString(length, characters) {
            let result = '';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        // Define the pattern for the random token
        const randomToken = `${generateRandomString(2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')}${generateRandomString(2, '0123456789')}${generateRandomString(2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')}`;

        // Set the generated token to the input field
        $('#token').val(randomToken);
    }
</script>
@endpush