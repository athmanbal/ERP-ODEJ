            <div class="flex bg-gray-100 border-b-1 border-gray-600 uppercase  text-sm md:text-md   dark:text-gray-100"
                style="text-shadow: 2px 2px 4px rgba(24, 7, 132, 0.5);">

                @foreach ($corps as $corp)

                    <a href="{{ route('fonctionaires', ['corp' => $corp->Id_Corps]) }}"
                        class="w-1/{{ count($corps) }} text-center  font-semibold hover:bg-blue-200 hover:text-blue-800
                       ">


                        <div
                            class="relative  rounded-l-12xl p-1
                            {{ $activeCorpId == $corp->Id_Corps ? 'border-b border-blue-400 bg-white text-blue-800' : '' }}">
                            {{ $corp->Nom_Corps }}
                            <div
                                class="absolute left-5 top-1/2 transform -translate-x-1/2 -bottom-4 w-2 h-2  rotate-45
                                     {{ $activeCorpId == $corp->id_corps ? 'border-b-1 border-blue-400 bg-gray-900 text-gray-200' : '' }}"">
                            </div>

                            <div
                                class="absolute top-0 left-0 w-8 h-12 border-t-8 border-l-8 border-t-transparent border-l-white">
                            </div>
                            <div
                                class="absolute top-0 right-0 w-8 h-12 border-t-8 border-r-8 border-t-transparent border-r-white">
                            </div>

                        </div>

                    </a>
                @endforeach

            </div>



            <!-- Flèche sous le div -->
