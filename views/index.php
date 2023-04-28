<?php include_once 'header.php'; ?>
    <h1>Your personal shopping list</h1>
    <?php if (isset($renderData)): ?>
        <ul>
            <?php foreach($renderData as $key => $shopItem): ?>
                <?php $isChecked = isset($shopItem['isChecked']) && $shopItem['isChecked'] === '1'; ?>
                <li>
                    <p>
                        <?php if ($isChecked): ?><s><?php endif; ?>
                            <?=$shopItem['name']?> <?=$shopItem['amount']?>
                        <?php if ($isChecked): ?></s><?php endif; ?>
                    </p>
                    <?php if (!$isChecked): ?>
                        <form style="float: left;" action="/check" method="POST">
                            <input type="hidden" name="id" value="<?=$key?>" />
                            <input type="submit" value="Check" />
                        </form>
                    <?php endif; ?>

                    <form action="/remove" method="POST">
                        <input type="hidden" name="id" value="<?=$key?>" />
                        <input type="submit" value="Remove" />
                    </form>

                    <?php if (!$isChecked): ?>
                        <a href="#">Edit</a>
                        <form style="display: none;" action="/edit" method="POST">
                            <input type="text" name="name" value="<?=$shopItem['name']?>?>" />
                            <input type="text" name="amount" value="<?=$shopItem['amount']?>" />
                            <input type="submit" value="Edit" />
                        </form>
                    <?php endif; ?>
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