<?php

namespace App\Traits;

use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Trait partagé par les contrôleurs qui génèrent des documents PDF
 * en arabe (attestation de travail, titre de congé, etc.).
 *
 * Reprend exactement la logique déjà utilisée dans
 * FonctionnaireController::genererAttestation() :
 *  - mPDF en priorité (rendu RTL natif, recommandé)
 *  - fallback DomPDF avec "shaping" manuel des caractères arabes
 */
trait GenerePdfArabe
{
    /**
     * Génère un PDF à partir d'une vue Blade et le renvoie en réponse HTTP.
     *
     * @param string $view        nom de la vue blade (ex: 'conges.pdf.titre-conge')
     * @param array  $data        données passées à la vue
     * @param string $nomFichier  nom de fichier (sans extension), peut contenir de l'arabe
     * @param string $mode        'inline' (aperçu navigateur) ou 'download'
     */
    protected function genererPdfArabe(string $view, array $data, string $nomFichier, string $mode = 'inline')
    {
        // Si mPDF est installé (recommandé pour un rendu RTL natif)
        if (class_exists(\Mpdf\Mpdf::class)) {
            $html = view($view, $data)->render();

            $mpdf = new \Mpdf\Mpdf([
                'mode'             => 'utf-8',
                'format'           => 'A4',
                'default_font'     => 'sans-serif',
                'margin_left'      => 10,
                'margin_right'     => 10,
                'margin_top'       => 10,
                'margin_bottom'    => 10,
                'autoScriptToLang' => true,
                'autoLangToFont'   => true,
            ]);

            $mpdf->WriteHTML($html);
            $pdfContent = $mpdf->Output('', 'S');

            return response($pdfContent, 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => ($mode === 'download' ? 'attachment' : 'inline') . '; filename="' . $nomFichier . '.pdf"',
            ]);
        }

        // Fallback DomPDF : formater le HTML pour ligaturer les caractères arabes et inverser le sens
        $rawHtml = view($view, $data)->render();
        $shapedHtml = $this->shapeArabicHtml($rawHtml);

        $pdf = Pdf::loadHTML($shapedHtml)
            ->setPaper('a4', 'portrait')
            ->setOption(['defaultFont' => 'DejaVu Sans', 'isHtml5ParserEnabled' => true]);

        return $mode === 'download'
            ? $pdf->download($nomFichier . '.pdf')
            : $pdf->stream($nomFichier . '.pdf');
    }

    /**
     * Traite les nœuds texte d'un document HTML pour connecter les lettres arabes
     * et les inverser pour DomPDF.
     */
    private function shapeArabicHtml($html)
    {
        $parts = preg_split('/(<style\b[^>]*>.*?<\/style>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $output = '';

        foreach ($parts as $part) {
            if (stripos($part, '<style') === 0) {
                $output .= $part;
            } else {
                $output .= preg_replace_callback('/>([^<]+)</u', function ($matches) {
                    $text = $matches[1];
                    $text = str_replace('&nbsp;', "\u{00A0}", $text);
                    $shaped = $this->shapeArabicString($text);
                    $shaped = str_replace("\u{00A0}", '&nbsp;', $shaped);
                    return '>' . $shaped . '<';
                }, $part);
            }
        }

        return $output;
    }

    /**
     * ⚠️ Colle ici le corps EXACT de ta méthode shapeArabicString() existante
     * (celle utilisée par genererAttestation dans FonctionnaireController).
     * Elle n'était pas incluse dans l'extrait que tu m'as donné — pour garder
     * un rendu strictement identique entre l'attestation et le titre de congé,
     * il faut réutiliser la même implémentation plutôt que d'en écrire une nouvelle.
     */
    private function shapeArabicString($text)
    {
        // TODO: coller ici le contenu de FonctionnaireController::shapeArabicString()
        return $text;
    }
}
