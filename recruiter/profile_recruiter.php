<?php
    include_once "header_recruiter.php";
?>

<section>
    <h3>Мій профіль</h3>
    <form action="../includes/profile_recruiter.inc.php" method="post" enctype="multipart/form-data">
        <div>
            <input type="radio" id="active" name="status" value="active" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "active") echo "checked";?>>
            <label for="active">Активний</label>
            <input type="radio" id="passive" name="status" value="passive" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "passive") echo "checked";?>>
            <label for="passive">Пасивний</label>
        </div><br><br>
        <label for="full_name">Моє призвіще та ім’я:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Full name" value="<?php $profileData->getFullName($_SESSION["user_id"]);?>"><br>
        <label for="position">Назва моєї посади:</label><br>
        <input type="text" id="position" name="position" placeholder="Position" value="<?php $profileData->getPosition($_SESSION["user_id"]);?>"><br>
        <label for="company">Назва компанії, де працюю:</label><br>
        <input type="text" id="company" name="company" placeholder="Company" value="<?php $profileData->getCompanyName($_SESSION["user_id"]);?>"><br>        
        <label for="country">Країна розташування компанії:</label><br>        
        <select name="country" id="country" size="1">
            <option value="Germany" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Germany") echo 'selected';?>>Germany</option>
            <option value="Ukraine" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Ukraine") echo 'selected';?>>Ukraine</option>
            <option value="Romania" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Romania") echo 'selected';?>>Romania</option>
            <option value="Czech Republic (Czechia)" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Czech Republic (Czechia)") echo 'selected';?>>Czech Republic (Czechia)</option>
            <option value="Hungary" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Hungary") echo 'selected';?>>Hungary</option>
            <option value="Austria" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Austria") echo 'selected';?>>Austria</option>
            <option value="Moldova" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Moldova") echo 'selected';?>>Moldova</option>
        </select><br>
        <img src="<?php echo $profileData->getLogo($_SESSION["user_id"]);?>" alt="Company logo" width="100" height="100"><br>
        <label for="photo_logo">Логотип компанії</label><br>
        <input type="file" id="photo_logo" name="logo"><br>
        <img src="<?php echo $profileData->getPhoto($_SESSION["user_id"]);?>" alt="User photo" width="160" height="100"><br>
        <input type="file" id="photo" name="photo"><br>
        <label for="description">Опис компанії:</label><br>
        <textarea name="description" id="description" rows="10" cols="50">
            <?php $profileData->getCompanyDescr($_SESSION["user_id"]);?>
        </textarea><br>
        <!-- <input type="text" id="description" name="description" placeholder="Description"><br> -->
        <button>Зберегти дані</button>
    </form>
</section>

<?php 
    echo $_SESSION["user_id"];
    echo $_SESSION["user_type"];
?>

<?php
    include_once "../footer.php";
?>