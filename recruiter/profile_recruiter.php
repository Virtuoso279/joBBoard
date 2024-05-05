<?php
    session_start();
    
    include_once "header_recruiter.php";
?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/recruiter/profile_recruiter.css">
</head>

<section class="main">
    <h3>Мій профіль</h3>
    <form action="../includes/profile_recruiter.inc.php" method="post" enctype="multipart/form-data">
        <div class="user-status-block">
            <div>
                <input type="radio" id="active" name="status" value="active" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "active") echo "checked";?>>
                <label for="active">Активний</label>
            </div>
            <div>
                <input type="radio" id="passive" name="status" value="passive" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "passive") echo "checked";?>>
                <label for="passive">Пасивний</label>
            </div>
        </div>
        <div class="columns">
            <div class="left-column">  
                <div class="column-item"> 
                    <label for="full_name">Моє призвіще та ім’я:</label><br>
                    <input type="text" id="full_name" name="full_name" placeholder="Full name" class="input-text" value="<?php $profileData->getFullName($_SESSION["user_id"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="position">Назва моєї посади:</label><br>
                    <input type="text" id="position" name="position" placeholder="Position" class="input-text" value="<?php $profileData->getPosition($_SESSION["user_id"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="company">Назва компанії, де працюю:</label><br>
                    <input type="text" id="company" name="company" placeholder="Company" class="input-text" value="<?php $profileData->getCompanyName($_SESSION["user_id"]);?>"><br>        
                </div>
                <div class="column-item">
                    <label for="country">Країна розташування компанії:</label><br>        
                    <select name="country" id="country" size="1">
                        <?php $profileData->getCountries($_SESSION["user_id"]) ?>
                    </select><br>
                </div>
                <div class="column-item">
                    <img src="<?php echo $profileData->getLogo($_SESSION["user_id"]);?>" alt="Company logo" width="100" height="100"><br><br>
                    <label for="photo_logo">Логотип компанії</label><br>
                    <input type="file" id="photo_logo" name="logo" class="resume-input"><br>
                </div>
                <div class="column-item">
                    <?php $profileData->checkProfileRecruiterErrors(); ?>
                </div>
                <button>Зберегти дані</button>
            </div>
            <div class="right-column">
                <div class="column-item">
                    <img src="<?php echo $profileData->getPhoto($_SESSION["user_id"]);?>" alt="User photo" width="160" height="100"><br>
                    <input type="file" id="photo" name="photo" class="resume-input"><br>
                </div>
                <div class="column-item">
                    <label for="description">Опис компанії:</label><br>
                    <textarea name="description" id="description" class="input-text" rows="10" cols="50"><?php $profileData->getCompanyDescr($_SESSION["user_id"]);?></textarea><br>
                </div>
            </div>
        </div>
    </form>
</section>

<?php
    include_once "../footer.php";
?>