<div class="p-4 border-b border-gray-200">
    <input type="text" id="recherche-fonctionnaire"
           class="w-full max-w-sm rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500"
           placeholder="Rechercher un fonctionnaire...">
</div>

<div class="max-h-96 overflow-y-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-50 sticky top-0">
            <tr>
                <th class="text-left px-5 py-2 font-medium text-gray-500">Fonctionnaire</th>
                <th class="text-right px-5 py-2 font-medium text-gray-500">Solde restant</th>
                <th class="text-right px-5 py-2 font-medium text-gray-500">Détail</th>
            </tr>
        </thead>
        <tbody id="corps-table-solde" class="divide-y divide-gray-100">
            @foreach ($fonctionnaires as $f)
                <tr class="ligne-fonctionnaire hover:bg-gray-50">
                    <td class="nom-fonctionnaire px-5 py-2">{{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}</td>
                    <td class="px-5 py-2 text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            {{ $f->solde <= 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ $f->solde }} j
                        </span>
                    </td>
                    <td class="px-5 py-2 text-right">
                        <a href="{{ route('conges.historique', $f->id_fonctionnaire) }}"
                           class="text-xs font-medium text-gray-600 border border-gray-300 rounded-md px-2 py-1 hover:bg-gray-100">
                            Historique
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr id="ligne-aucun-resultat" class="hidden">
                <td colspan="3" class="text-center text-gray-400 py-6">Aucun fonctionnaire trouvé</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
document.getElementById('recherche-fonctionnaire').addEventListener('input', function (e) {
    const terme = e.target.value.trim().toLowerCase();
    const lignes = document.querySelectorAll('#corps-table-solde .ligne-fonctionnaire');
    let visibleCount = 0;

    lignes.forEach(function (ligne) {
        const nom = ligne.querySelector('.nom-fonctionnaire').textContent.toLowerCase();
        const correspond = nom.includes(terme);
        ligne.classList.toggle('hidden', !correspond);
        if (correspond) visibleCount++;
    });

    document.getElementById('ligne-aucun-resultat').classList.toggle('hidden', visibleCount > 0);
});
</script>
