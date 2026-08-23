<!DOCTYPE html>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 15mm;
        }

        body {
            text-align: right;
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 10px;
            color: #000;
        }

        /* Cadre extérieur */
        .border-container {
            border: 3px double #1a365d;
            padding: 25px 20px;
            box-sizing: border-box;
        }

        /* En-tête */
        .header-top {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .title {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            margin: 30px 0 20px 0;
            text-decoration: underline;
        }

        .declaration {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .info-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 0;
            font-size: 15px;
            vertical-align: top;
        }

        .info-label {
            width: 25%;
            font-weight: bold;
        }

        .info-value {
            font-weight: bold;
        }

        .footer-law {
            margin-top: 35px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .signature-section {
            margin-top: 40px;
            text-align: left;
            padding-left: 50px;
        }

        .signature-title {
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="border-container">

        <!-- En-tête haut -->
        <div class="header-top">
            الجمهورية الجزائرية الديمقراطية الشعبية<br>
            وزارة الشباب والرياضة
        </div>

        <!-- En-tête détails avec tableau pour stabilité RTL -->
        <table class="header-table">
            <tr>
                <td></td>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    مديرية الشباب والرياضة لولاية البويرة<br>
            <tr>
                <td></td>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">

                    ديوان مؤسسات الشباب لولاية البويرة<br>
            <tr>
                <td></td>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">

                    مصلحة الإدارة والوسائل<br>
            <tr>
                <td></td>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">

                    فرع الموارد البشرية والمالية
            <tr>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    البويرة في : .........................
                </td>
                <td style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">

                    الرقم : ............./د.م.ش /{{ date('Y') }}
                </td>
            </tr>
        </table>

        <!-- Titre -->
        <div class="title">
            شهادة عمل
        </div>

        <!-- Texte de déclaration -->
        <div class="declaration">
            يشهد السيد : مدير ديوان مؤسسات الشباب لولاية البويرة الممضي أسفله أن :
        </div>

        <!-- Tableau des informations -->
        <table class="info-table" style=" text-align: right;">
            <tr>

                <td class="info-value" style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    {{ $fonctionnaire->nom_fonctionnaire }} {{ $fonctionnaire->prenom_fonctionnaire }}
                </td>
                <td class="info-label" >
                    {{ $fonctionnaire->sexe == 'F' ? 'السيدة :' : 'السيد :' }}
                </td>
            </tr>
            <tr>
                <td class="info-value" style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    {{ $fonctionnaire->date_naissance ? \Carbon\Carbon::parse($fonctionnaire->date_naissance)->format('Y/m/d') : '' }}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    بـ : {{ $fonctionnaire->lieu_naissance ?? 'البويرة' }}
                </td>
                <td class="info-label">تاريخ ومكان الميلاد :</td>

            </tr>
            <tr>
                <td class="info-value" style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    {{ $fonctionnaire->fonction->nom_fonction ?? '' }}</td>
                <td class="info-label">الوظيفة :</td>

            </tr>
            <tr>

                <td class="info-value" style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">

                    {{ $fonctionnaire->date_recretement ? \Carbon\Carbon::parse($fonctionnaire->date_recretement)->format('Y/m/d') : '' }}
                     {{ $fonctionnaire->sexe == 'F' ? 'موظفة' : 'موظف' }} ضمن مصالحي بصفة دائمة إبتداء من :
                </td>
                <td class="info-label">صفة التوظيف :</td>
            </tr>
            <tr>

                <td class="info-value" style="width: 60%; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.6;">
                    {{ $fonctionnaire->date_sortie ? \Carbon\Carbon::parse($fonctionnaire->date_sortie)->format('Y/m/d') : 'يومنا هذا .' }}
                </td>
                <td class="info-label">إلى غاية :</td>
            </tr>
        </table>

        <!-- Mention légale -->
        <div class="footer-law">
            سلمت {{ $fonctionnaire->sexe == 'F' ? 'لها' : 'له' }} هذه الشهادة لإستعمالها فيما يسمح به القانون.
        </div>

        <!-- Signature Directeur -->
        <div class="signature-section">
            <span class="signature-title">الـــمـــديــــر</span>
        </div>

    </div>

</body>

</html>
