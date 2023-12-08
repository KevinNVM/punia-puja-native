<x-guest-layout>

    <style>
        *::-webkit-scrollbar {
            display: none;
        }
    </style>

    <section class="relative bg-gray-900 text-white bg-top bg-cover" style="background-image: url('/img/pura - (1).jpg')">

        <div class="absolute top-0 right-0 z-10 p-4">
            <a class="btn btn-ghost" href="{{ route('dashboard') }}">Dashboard</a>
        </div>

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-black/0" data-aos="fade-up" data-aos-delay="500"
            data-aos-once="true">
            <div class="mx-auto px-4 py-32 lg:flex h-screen lg:items-center">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 data-aos="fade-up" data-aos-delay="550"
                        class="bg-gradient-to-r from-amber-100 via-white-500 to-purple-300 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl">
                        Dana Punia

                        <span class="sm:block"> Pura Aditya Jaya </span>
                    </h1>


                    <p data-aos="fade-up" data-aos-delay="600" class="mx-auto mt-4 max-w-xl sm:text-xl/relaxed">
                        Berikanlah dengan ikhlas, bunga bhakti kepada pura ini, sehingga keberkahan senantiasa mengalir
                        dalam tempat ibadah kita bersama.
                    </p>


                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a data-aos="fade-up" data-aos-delay="650" class="w-full max-w-xs btn btn-primary"
                            href="#table">
                            Lihat Tabel Punia
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl h-screen"></div>

    </section>

    <section class="relative bg-gray-900 text-white bg-center bg-cover"
        style="background-image: url('/img/pura - (2).jpg')" id="table">

        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-gray-900/20 ">
            <div class="mx-auto px-4 py-32 lg:flex h-screen lg:items-center justify-center">
                <div class="overflow-x-auto p-4" data-aos="fade-up" data-aos-delay="100">
                    @livewire('public-tx-table')
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl h-screen"></div>

    </section>



    @if (env('APP_ENV') == 'local' && env('APP_DEBUG'))
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Perhatian!",
                    text: 'Website ini masih dalam tahap uji coba.\nPesan ini akan hilang jika website sudah berjalan normal',
                    timer: 3500,
                })
            })
        </script>
    @endif

</x-guest-layout>
