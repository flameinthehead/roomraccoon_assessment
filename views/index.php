<?php include_once 'header.php'; ?>
    <h1>Your personal shopping list</h1>
    <?php if (isset($renderData)): ?>
        <ul>
            <?php foreach($renderData as $key => $shopItem): ?>
                <li><?=$shopItem['name']?> <?=$shopItem['amount']?>
                    <form action="/remove" method="POST">
                        <input type="hidden" name="id" value="<?=$key?>" />
                        <input type="submit" value="Remove" />
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nothind added yet.</p>
    <?php endif; ?>
    <form action="/add" method="POST">
        <label>
            <input name="name" placeholder="Shop item name" value="<?=($_REQUEST['name'] ?? '')?>"/>
        </label><br />
        <label>
            <input type="text" name="amount" placeholder="Shop item amount" value="<?=($_REQUEST['amount'] ?? '')?>" />
        </label><br />
        <input type="submit" value="Add" />
    </form>
<?php include_once 'footer.php'; ?>