<label for="num_tickets_retour">Ticket retour :</label><br>
        <select name="num_tickets_retour">
            <?php foreach ($tickets_retour as $ticket_retour) { ?>
                <option value="<?= $ticket_retour['Num_Ticket_SAV'] ?>"><?= $ticket_retour['Num_Ticket_SAV'] ?></option>
            <?php } ?>
        </select><br><br>