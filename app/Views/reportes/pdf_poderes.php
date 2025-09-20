<?= view('reportes/css/estilos_tarea') ?>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <h2 style="text-align:center">Poderes de <?= esc($hero['superhero_name']) ?></h2>
    
    <table class="table" style="width:100%; table-layout:fixed;">
        <tr>
            <th style="width:30%;">Nombre Real</th>
            <td style="width:70%;"><?= esc($hero['full_name'] ?? 'No especificado') ?></td>
        </tr>
        <tr>
            <th>Poderes</th>
            <td style="word-wrap:break-word; white-space:pre-wrap;">
                <?= str_replace(',', ',<br>', esc($hero['powers'] ?? 'No tiene poderes registrados')) ?>
            </td>
        </tr>
    </table>
</page>
