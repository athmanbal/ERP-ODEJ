<!-- resources/views/pdf-preview.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aperçu du PDF</title>
    <style>
        #pdf-container {
            width: 100%;
            height: 500px;
            overflow: auto;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>Aperçu du PDF</h1>
    <div id="pdf-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        var url = '{{ $pdfUrl }}';  // L'URL de votre fichier PDF récupéré depuis Media Library

        // Chargement du PDF avec pdf.js
        pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
            var pdfDoc = pdfDoc_;
            var pageNum = 1;
            var scale = 1.5;
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            document.getElementById('pdf-container').appendChild(canvas);

            // Fonction pour afficher une page
            function renderPage(num) {
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport({ scale: scale });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    page.render({
                        canvasContext: ctx,
                        viewport: viewport
                    });
                });
            }

            // Rendre la première page
            renderPage(pageNum);
        });
    </script>
</body>
</html>
