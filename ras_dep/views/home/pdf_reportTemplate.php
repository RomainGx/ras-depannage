<h1 style="text-align: center;">Rapport de dépannage</h1>
<i style="text-align: center;">Généré le <?php echo date('d/m/Y'); ?> à <?php echo date('h:i'); ?></i>

<br /><br />

<p>Une copie de ce rapport a été envoyée aux adresses <?php echo $clientMail; ?> et romain.archimbaud@rasecurite.fr</p>

<hr/>
<p> </p>

<table>
    <tr>
        <th><strong>Client</strong> :</th>
        <th><?php echo $client; ?></th>
    </tr>
    <tr>
        <th><strong>Technicien</strong> :</th>
        <th>Romain Archimbaud</th>
    </tr>
    <tr>
        <th><strong>Début de l'intervention</strong> :</th>
        <th><?php echo $dateBegin . ' ' . $timeBegin; ?></th>
    </tr>
    <tr>
        <th><strong>Fin de l'intervention</strong> :</th>
        <th><?php echo $dateEnd . ' ' . $timeEnding; ?></th>
    </tr>
</table>

<br/><br/>

<strong>Rapport</strong> :<br/>
<?php echo nl2br($report); ?>

<br/><br/>

<strong>Signature du client</strong> :<br/>
<img src="<?php echo $clientSignName; ?>" alt="Erreur signature"/>

<br />

<strong>Signature du technicien</strong> :<br/>
<img src="<?php echo $techSignName; ?>" alt="Erreur signature"/>