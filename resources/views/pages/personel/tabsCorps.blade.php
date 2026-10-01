           <div class="flex   uppercase m-0 mt-0 bg-gray-100 ">
               <div
                   class="flex  w-full uppercase mb-0 mt-2 bg-gray-100 border-b-4 border-white text-sm md:text-md   dark:text-gray-100">


                   @foreach ($corps as $corp)
                       <a href="{{ route('fonctionaires', ['corp' => $corp->Id_Corps]) }}"
                           class="w-1/{{ count($corps) * 2 }} text-center
                                        px-4
                                        border-l-4
                                        transition-all duration-300 rounded-t-2xl
                                        hover:border-blue-900 hover:border-2  hover:border-l-4
                                        {{ $activeCorpId == $corp->Id_Corps ? 'bg-white text-blue-900 border-blue-700' : 'text-gray-900' }}">


                           <div class="relative    px-2 py-2  text-sm  text-gray-700 dark:text-gray-200">
                               <span
                                   class="ml-1 m-2 min-w-[24px] h-6 flex items-center justify-center
                                    rounded-full  lowercase  text-2xl font-bold">
                                   {{ $corp->fonctionnaires_count }}

                               </span>
                               {{ $corp->Nom_Corps }}





                           </div>

                       </a>
                   @endforeach
               </div>

           </div>



           <!-- Flèche sous le div -->
