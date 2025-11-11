<?php
    $logo = DB::table('app_logos')->first();
?>
<div class="brand-logo pb-4 text-center">
    <a href="{{ route('home.index') }}" class="logo-link">
        <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/logo/'.$logo->logo) }}" srcset="{{ asset('assets/logo/'.$logo->logo) }} 2x" alt="logo">
        <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/logo/'.$logo->logo) }}" srcset="{{ asset('assets/logo/'.$logo->logo) }} 2x" alt="logo-dark">
    </a>
</div>
