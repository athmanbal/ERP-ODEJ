<x-app-layout>
    


<h1>Gestionnaire de fichiers</h1>

<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">Choisir un fichier</a>
<img id="holder" style="margin-top:15px;max-height:100px;">

<script src="https://cdn.jsdelivr.net/npm/laravel-filemanager/js/lfm.js"></script>
<script>
    $('#lfm').filemanager('image', { prefix: route_prefix });
</script>
</x-app-layout>