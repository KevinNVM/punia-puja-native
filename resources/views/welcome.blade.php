<x-guest-layout>

    <section class="relative bg-gray-900 text-white bg-top bg-cover"
        style="background-image: url({{ url('/img/bali.jpg') }})">

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-black/0">
            <div class="mx-auto px-4 py-32 lg:flex h-screen lg:items-center">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 data-aos="fade-up" data-aos-delay="50"
                        class="bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl">
                        Transparansi Dana Punia.

                        <span class="sm:block"> Dari Kita Untuk Kita. </span>
                    </h1>

                    <p data-aos="fade-up" data-aos-delay="100" class="mx-auto mt-4 max-w-xl sm:text-xl/relaxed">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo
                        tenetur fuga ducimus numquam ea!
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a data-aos="fade-up" data-aos-delay="150" class="w-full max-w-xs btn btn-primary"
                            href="#table">
                            Lihat Tabel
                        </a>
                        <a data-aos="fade-up" data-aos-delay="160" class="w-full max-w-xs btn btn-ghost"
                            href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl h-screen"></div>

    </section>

    <section class="relative bg-gray-900 text-white bg-center bg-cover"
        style="background-image: url({{ url('/img/collage-bali.png') }})" id="table">

        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-gray-900/20 ">
            <div class="mx-auto px-4 py-32 lg:flex h-screen lg:items-center justify-center">
                <div class="overflow-x-auto p-4" data-aos="fade-up" data-aos-delay="100">
                    @livewire('public-tx-table')
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl h-screen"></div>

    </section>

</x-guest-layout>
