<?php foreach ($heroes as $hero_item): ?>

        <h3><?php echo $hero_item['heroID']; ?></h3>
        <div class="main">
                <?php echo $hero_item['heroname']; ?>
        </div>
        

<?php endforeach; ?>