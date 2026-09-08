<table id="TableFonctionaires" class="w-full border-collapse bg-white text-left text-sm text-gray-500 ">
    <thead class="bg-gray-50">
        <tr class="uppercase underline underline-offset-8">
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Non Prenom</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900"> Date_Naissance</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Grade</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Etablissement</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Corps</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Ations</th>
        </tr>
    </thead>





    <tbody class="divide-y divide-gray-100 border-t border-gray-100 bg-gray-10 ">
@include('pages.personel.partials.tablefonctionnaires')
    </tbody>
</table>

    <!-- ================================================= Boîte de confirmation suppressin personnalisée -->
<div id="customConfirmFonct" class="hidden fixed inset-0 flex items-center justify-center bg-black/40 z-50">
    <div class="bg-white p-4 rounded shadow">
        <p>Voulez-vous vraiment supprimer ce fonctionnaire ?</p>
        <button id="confirmYes" class="bg-red-600 text-white px-3 py-1 rounded">Oui</button>
        <button id="confirmNo" class="bg-gray-300 px-3 py-1 rounded">Annuler</button>
    </div>
</div>
