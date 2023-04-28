<?php include_once 'header.php'; ?>
    <h1>Your personal shopping list</h1>
    <?php if (isset($renderData['shoppingList'])): ?>
        <ul>
            <?php foreach($renderData['shoppingList'] as $shopItem): ?>
                <li><?=$shopItem->title?> <?=$shopItem->amount?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nothind added yet.</p>
    <?php endif; ?>
    <form action="/add" method="POST">
        <label>
            <input name="title" placeholder="Shop item title" />
        </label><br />
        <label>
            <input type="text" name="title" placeholder="Shop item amount" />
        </label><br />
        <input type="submit" value="Add" />
    </form>
<?php include_once 'footer.php'; ?>