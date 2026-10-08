<table id="TableEtablissements" class="w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
        <tr class="uppercase underline underline-offset-8">
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nom</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Type</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Adresse</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tél / Fax</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">E-mail</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Effectif</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100 bg-gray-10">
        @foreach ($etablissements as $etablissement)
            <tr class="hover:bg-gray-200">
                <td class="px-6 py-4 font-bold text-gray-900">{{ $etablissement->nom_etablissement }}</td>
                <td class="px-6 py-4">{{ $etablissement->type_etablissement }}</td>
                <td class="px-6 py-4">{{ $etablissement->address_etablissement }}</td>
                <td class="px-6 py-4">{{ $etablissement->telFax_etablissement }}</td>
                <td class="px-6 py-4">{{ $etablissement->mail_etablissement }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600">
                        {{ $etablissement->fonctionnaires_count }}
                    </span>
                </td>
                <td class="px-1 py-1">
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('etablissements.edit', $etablissement->id_etablissement) }}"
                            class="btn p-1 border-0 border-b-2 border-gray-800 text-gray-900 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </a>

                        <form action="{{ route('etablissements.destroy', $etablissement->id_etablissement) }}"
                            method="POST" onsubmit="return openCustomConfirmEtab(event, this);">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn p-1 border-0 border-b-2 border-red-800 text-red-900 hover:bg-red-500 hover:text-red-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
