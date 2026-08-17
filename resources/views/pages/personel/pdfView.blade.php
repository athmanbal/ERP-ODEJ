<!-- resources/views/pdf-view.blade.php -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualiser le PDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
</head>
<body>
    <div id="pdf-viewer" style="width: 100%; height: 600px;"></div>

    <script>
        const pdfUrl = "http://127.0.0.1:8000/storage/20/csp-elesnam-(2).jpg"; // Chemin du PDF

        // Charger le PDF
        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            pdf.getPage(1).then(page => {  // Afficher la première page
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: 1 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({ canvasContext: context, viewport: viewport });

                // Ajouter le canvas à l'élément #pdf-viewer
                document.getElementById('pdf-viewer').appendChild(canvas);
            });
        });
    </script>
</body>
</html>