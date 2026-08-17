            <div class="flex border-b-1 border-gray-800 bg-gray-200">
                @foreach($corps as $corp)
                
                    <a href="{{ route('fonctionaires', ['corp' => $corp->id_corps]) }}"
                        class="w-1/{{ count($corps) }} text-center  font-semibold hover:bg-gray-200 hover:text-blue-800 
                       ">




                        <div class="relative  rounded-l-12xl p-1
                            {{ $activeCorpId == $corp->id_corps ? 'border-b border-blue-400 bg-white text-blue-600' : '' }}">
                            {{ $corp->nom_corps }}
                            <div class="absolute left-5 top-1/2 transform -translate-x-1/2 -bottom-4 w-2 h-2  rotate-45
                                     {{ $activeCorpId == $corp->id_corps ? 'border-b-1 border-blue-400 bg-gray-900 text-gray-200' : '' }}""></div>
                                     
                                     <div class="absolute top-0 left-0 w-8 h-12 border-t-8 border-l-8 border-t-transparent border-l-white"></div>
                                     <div class="absolute top-0 right-0 w-8 h-12 border-t-8 border-r-8 border-t-transparent border-r-white"></div>
    
                        </div>
                     
                    </a>
                @endforeach
           
            </div>


            
                <!-- Flèche sous le div -->
