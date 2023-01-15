@extends('layout.registerlayout')

<style>
    /* The hero image */
    .hero-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("image/Home Layout.jpg");
        height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .hero-title {
        text-align: center;
        position: absolute;
        top: 15%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }

    .hero-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }
</style>


@section('content')
    <div class="hero-image">
        <div class="hero-title">
            <h1 class="display-4">RISEL</h1>
        </div>
        <div class="hero-text">
            <h1>Platform yang menghubungkan Owner dengan Dropshipper</h1>
            <br><br><br>
            <h4>Membangun hubungan bisnis B2B antara Owner dan Dropshipper di mana Owner dapat meminta bantuan dropshipper untuk menjualkan barangnya dan dropshipper bisa menjualkan barang mirip owner.</h4>
        </div>
    </div>
@endsection