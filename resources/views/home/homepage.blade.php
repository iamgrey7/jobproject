
@extends('layouts.app')

@section('title')
    <title>Homepage</title>
@endsection

@section('content')
<header class="bg-none mb-5">
    <img src="img/2.jpg" width="100%">
</header>
      
    {{-- Isi --}}
<div class="container">
    <div class="row">
        <!-- Konten 1 -->
        <div class="col-md-8 mb-5">
            <h2>What We Do</h2>
            <hr>
            <p>GREY.CO merupakan perusahaan terdepan di bidang jasa desain, programming, penulisan, 
            dan online marketing, dengan tenaga professional yang memiliki pengalaman lebih dari 10 tahun.</p>
            <h2>Our History</h2>
            <hr>
            <p>GREY.CO berdiri bulan Juli 2014 dengan tujuan memberi kesempatan pada freelancer 
            untuk berkarya, dan menjembatani individu atau institusi menemukan mitra kerja yang tepat.</p>
            
            <h2>Our Motto</h2>
            <hr>
            <p>Future of work merupakan motto GREY.CO Kami berkarya untuk masa depan. 
            Temukan ide-ide kreatif bersama para professional kami, dan kepuasan Anda menjadi 
            capaian terbesar kami.</p>
            <hr>      
            <a class="btn btn-primary btn-lg" href={{url('/profile')}}>Selengkapnya &raquo;</a>
        </div>
    
        <!-- Konten 2 -->
        <div class="col-md-4 mb-5">
            <h2>Contact Us</h2>
                <ul>
                <li>Jl. Pajajaran No.23 - Bandung</li>
                <li>022-999876</li>
                </ul>
            <hr>        
        </div>
    </div>
</div>

{{-- modal untuk login --}}
@include('auth.login')


@endsection

@section('script')
<script>
    
</script>

@endsection
