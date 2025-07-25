<section class="content__form">
  <div class="inner">
    <div class="form__container">
      <form action="process.php" method="POST" id="predictionForm">
        <!-- FOR EASTERN AND WESTER CONFERENCE -->
        <div class="predict--conference">
          <!-- Western Conference -->
          <div class="predict--western-form">
            <img class="team--ico-head" src="./assets/images/prediction/team-ico/western.png" alt="Western">
            <label><?php echo $teamselect1; ?></label>
            <div class="predict--custom-dropdown" data-target="team1">
              <button type="button" class="dropdown-btn" data-placeholder="<?php echo $selectteam; ?>"></button>
              <ul class="dropdown-list">
                <div class="inner-dropdown">
                  <li class="dropdown-item" data-value="Thunder"
                    data-img="./assets/images/prediction/team-ico/western/Thunder.png"><img
                      src="./assets/images/prediction/team-ico/western/Thunder.png" alt=" Thunder"> Thunder
                  </li>
                  <li class="dropdown-item" data-value="Lakers"
                    data-img="./assets/images/prediction/team-ico/western/Lakers.png"><img
                      src="./assets/images/prediction/team-ico/western/Lakers.png" alt=" Lakers"> Lakers
                  </li>
                  <li class="dropdown-item" data-value="Nuggets"
                    data-img="./assets/images/prediction/team-ico/western/Nuggets.png"><img
                      src="./assets/images/prediction/team-ico/western/Nuggets.png" alt=" Nuggets"> Nuggets
                  </li>
                  <li class="dropdown-item" data-value="Grizzlies"
                    data-img="./assets/images/prediction/team-ico/western/Grizzles.png"><img
                      src="./assets/images/prediction/team-ico/western/Grizzles.png" alt=" Grizzlies">
                    Grizzlies
                  </li>
                  <li class="dropdown-item" data-value="Rockets"
                    data-img="./assets/images/prediction/team-ico/western/Rockets.png"><img
                      src="./assets/images/prediction/team-ico/western/Rockets.png" alt=" Rockets">
                    Rockets
                  </li>
                  <li class="dropdown-item" data-value="Warriors"
                    data-img="./assets/images/prediction/team-ico/western/Warriors.png"><img
                      src="./assets/images/prediction/team-ico/western/Warriors.png" alt=" Warriors"> Warriors
                  </li>
                  <li class="dropdown-item" data-value="Clippers"
                    data-img="./assets/images/prediction/team-ico/western/Clippers.png"><img
                      src="./assets/images/prediction/team-ico/western/Clippers.png" alt=" Clippers"> Clippers
                  </li>
                  <li class="dropdown-item" data-value="Kings"
                    data-img="./assets/images/prediction/team-ico/western/Kings.png"><img
                      src="./assets/images/prediction/team-ico/western/Kings.png" alt=" Kings">
                    Kings
                  </li>
                  <li class="dropdown-item" data-value="Timberwolves"
                    data-img="./assets/images/prediction/team-ico/western/Timberwolves.png"><img
                      src="./assets/images/prediction/team-ico/western/Timberwolves.png" alt="Timberwolves">Timberwolves
                  </li>
                  <li class="dropdown-item" data-value="Mavericks"
                    data-img="./assets/images/prediction/team-ico/western/Mavericks.png"><img
                      src="./assets/images/prediction/team-ico/western/Mavericks.png" alt="Mavericks">
                    Mavericks
                  </li>
                  <li class="dropdown-item" data-value="Suns"
                    data-img="./assets/images/prediction/team-ico/western/Suns.png"><img
                      src="./assets/images/prediction/team-ico/western/Suns.png" alt=" Suns"> Suns
                  </li>
                  <li class="dropdown-item" data-value="Trail Blazers"
                    data-img="./assets/images/prediction/team-ico/western/Trailblazers.png"><img
                      src="./assets/images/prediction/team-ico/western/Trailblazers.png" alt=" Trailblazers">
                    Trail Blazers
                  </li>
                  <li class="dropdown-item" data-value="Spurs"
                    data-img="./assets/images/prediction/team-ico/western/Spurs.png"><img
                      src="./assets/images/prediction/team-ico/western/Spurs.png" alt=" Spurs">
                    Spurs
                  </li>
                  <li class="dropdown-item" data-value="Pelicans"
                    data-img="./assets/images/prediction/team-ico/western/Pelicans.png"><img
                      src="./assets/images/prediction/team-ico/western/Pelicans.png" alt=" Pelicans">Pelicans
                  </li>
                  <li class="dropdown-item" data-value="Jazz"
                    data-img="./assets/images/prediction/team-ico/western/Jazz.png"><img
                      src="./assets/images/prediction/team-ico/western/Jazz.png" alt=" Jazz">
                    Jazz
                  </li>
                </div>
              </ul>
            </div>
            <input type="hidden" name="team1" id="team1">
          </div>

          <!-- Eastern Conference -->
          <div class="predict--eastern-form">
            <img class="team--ico-head" src="./assets/images/prediction/team-ico/eastern.png" alt="Eastern">
            <label><?php echo $teamselect2; ?></label>
            <div class="predict--custom-dropdown" data-target="team2">
              <button type="button" class="dropdown-btn" data-placeholder="<?php echo $selectteam; ?>"></button>
              <ul class="dropdown-list">
                <div class="inner-dropdown">
                  <li class="dropdown-item" data-value="Cavaliers"
                    data-img="./assets/images/prediction/team-ico/eastern/Cavaliers.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Cavaliers.png" alt=" Cavaliers">
                    Cavaliers
                  </li>
                  <li class="dropdown-item" data-value="Celtics"
                    data-img="./assets/images/prediction/team-ico/eastern/Celtics.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Celtics.png" alt=" Celtics"> Celtics
                  </li>
                  <li class="dropdown-item" data-value="Knicks"
                    data-img="./assets/images/prediction/team-ico/eastern/Knicks.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Knicks.png" alt=" Knicks"> Knicks
                  </li>
                  <li class="dropdown-item" data-value="Bucks"
                    data-img="./assets/images/prediction/team-ico/eastern/Bucks.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Bucks.png" alt=" Bucks">
                    Bucks
                  </li>
                  <li class="dropdown-item" data-value="Pacers"
                    data-img="./assets/images/prediction/team-ico/eastern/Pacers.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Pacers.png" alt=" Pacers"> Pacers
                  </li>
                  <li class="dropdown-item" data-value="Pistons"
                    data-img="./assets/images/prediction/team-ico/eastern/Pistons.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Pistons.png" alt=" Pistons">
                    Pistons
                  </li>
                  <li class="dropdown-item" data-value="Heat"
                    data-img="./assets/images/prediction/team-ico/eastern/Heat.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Heat.png" alt=" Heat"> Heat
                  </li>
                  <li class="dropdown-item" data-value="Magic"
                    data-img="./assets/images/prediction/team-ico/eastern/Magic.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Magic.png" alt=" Magic"> Magic
                  </li>
                  <li class="dropdown-item" data-value="Hawks"
                    data-img="./assets/images/prediction/team-ico/eastern/Hawks.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Hawks.png" alt=" Hawks"> Hawks
                  </li>
                  <li class="dropdown-item" data-value="Bulls"
                    data-img="./assets/images/prediction/team-ico/eastern/Bulls.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Bulls.png" alt=" Bulls"> Bulls
                  </li>
                  <li class="dropdown-item" data-value="Nets"
                    data-img="./assets/images/prediction/team-ico/eastern/Nets.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Nets.png" alt=" Nets"> Nets
                  </li>
                  <li class="dropdown-item" data-value="76ers"
                    data-img="./assets/images/prediction/team-ico/eastern/76ers.png"><img
                      src="./assets/images/prediction/team-ico/eastern/76ers.png" alt=" 76ers"> 76ers
                  </li>
                  <li class="dropdown-item" data-value="Raptors"
                    data-img="./assets/images/prediction/team-ico/eastern/Raptors.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Raptors.png" alt=" Raptors">
                    Raptors
                  </li>
                  <li class="dropdown-item" data-value="Hornets"
                    data-img="./assets/images/prediction/team-ico/eastern/Hornets.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Hornets.png" alt=" Hornets">
                    Hornets
                  </li>
                  <li class="dropdown-item" data-value="Wizards"
                    data-img="./assets/images/prediction/team-ico/eastern/Wizards.png"><img
                      src="./assets/images/prediction/team-ico/eastern/Wizards.png" alt=" Wizards">
                    Wizards
                  </li>
                </div>
              </ul>
            </div>
            <input type="hidden" name="team2" id="team2">
          </div>
        </div>

        <!-- FOR THE BRACKET -->
        <div class="predict--bracket">
          <div class="bracket--line-one"></div>
          <div class="bracket--line-two"></div>
        </div>

        <!-- Finals Selection -->
        <div class="predict--final">
          <div class="final--cover">
            <img class="final--ico" src="<?php echo $thefinalsico; ?>" alt="The Finals Ico">
            <label><?php echo $teamselectall; ?></label>
            <div class="predict--custom-dropdown" id="finalist-dropdown" data-target="selected_team">
              <button type="button" class="dropdown-btn" data-placeholder="<?php echo $selectteam; ?>"
                placeholder="<?php echo $selectteam; ?>">
                <span class="selected-image"></span> <?php echo $selectfinalist ?>
              </button>
              <ul class="dropdown-list" id="finalist-options"></ul>
            </div>
            <input type="hidden" name="selected_team" id="selected_team">
          </div>
        </div>

        <!-- FOR THE SUBMIT FORM -->
        <div class="predict--submit-form">
          <div class="predict--submit-box">
            <input name="selected_lang" type="hidden" value="<?php echo $langchoices; ?>">
            <label for="username">Username</label>
            <div class="input-container">
              <input type="text" name="username" class="input-disabled" id="username"
                data-placeholder="<?php echo $enterusername; ?>" placeholder="<?php echo $enterusername; ?>" required>
              <span class="clear-input" id="clear-username">
                <img src="<?php echo $clearico ?>" alt="Clear Ico" class="clear--input" id="clear--username">
              </span>
            </div>
            <div class="predict--error-snackbar">
              <div class="snackbar--item">
                <p><?php echo $snackbartxt ?></p>
              </div>
            </div>
          </div>
          <button type="submit"><?php echo $teamsubmit; ?></button>
          <span><?php echo $spannotice ?></span>
        </div>
      </form>
    </div>
  </div>
</section>

<div class="predict--modal-overlay">
  <section class="predict--modal modal--success">
    <div class="predict--modal-header">
      <img src="<?php echo $modalcloseico; ?>" alt="<?php echo $modalcloseicoalt; ?>">
    </div>
    <div class="predict--modal-body">
      <img src="<?php echo $succeslogo; ?>" alt="<?php echo $succeslogoalt; ?>">
      <h5><?php echo $submittitle; ?></h5>
      <p><?php echo $submitcontent; ?></p>
    </div>
    <div class="predict--modal-footer">
      <button><?php echo $submitbutton ?></button>
    </div>
  </section>

  <section class="predict--modal modal--error">
    <div class="predict--modal-header">
      <img src="<?php echo $modalcloseico; ?>" alt="<?php echo $modalcloseicoalt; ?>">
    </div>
    <div class="predict--modal-body">
      <img src="<?php echo $errorlogo; ?>" alt="<?php echo $errorlogoalt; ?>">
      <h5><?php echo $errorsubmittitle; ?></h5>
      <p><?php echo $errorsubmitcontent; ?></p>
    </div>
    <div class="predict--modal-footer">
      <button><?php echo $submitbutton ?></button>
    </div>
  </section>
</div>

<div class="modal">
  <div class="modal-content">

    <div class="modal--steps">
      <!-- Step 1: Username Input -->
      <div id="step1" class="step1--modal-content">

        <div class="close-button-container">
          <div class="close--btn-container-list1">
            <p><?php echo $ctamodal; ?></p>
          </div>
          <img class="close-button" src="<?php echo $modalcloseico ?>" alt="Modal Close">
        </div>

        <div class="step1--has-body">
          <p><?php echo $predictiontextresult; ?></p>
          <div class="step1--modal-content-flex">
            <label for="usernameInput"><?php echo $predictionlabelusername ?></label>
            <div class="input-container">
              <input type="text" id="usernameInput" placeholder="<?php echo $enterusername; ?>">
              <span class="clear-input" id="clear-usernameInput">
                <img src="<?php echo $clearico ?>" alt="Clear Ico" class="clear--input" id="clear--username">
              </span>
            </div>
            <div class="predict--error-snackbar">
              <div class="snackbar--item">
                <p><?php echo $snackbartxt ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal--btn-holder">
          <button class="check-btn"><?php echo $submitpredictionresult; ?></button>
        </div>
      </div>

      <!-- Step 2: Prediction Display (Initially Hidden) -->
      <div id="step2" class="hidden has--padding">
        <div class="close-button-container">
          <div class="close--btn-container-list1">
            <img class="has--previous-btn" src="./assets/images/icons/ico-left.svg" alt="">
            <p><?php echo $ctamodal; ?></p>
          </div>
          <img class="close-button" src="<?php echo $modalcloseico ?>" alt="Modal Close">
        </div>
        <div class="has--team-selections">
          <div class="team--has-pick team--selected1">
            <img src="" alt="Western Conference Champion Logo">
            <div class="team--has-show">
              <span id="team1check" class="has--base100"></span>
              <span class="has--base80"><?php echo $modalwesternresult ?></span>
            </div>
          </div>
          <div class="team--has-pick team--selected2">
            <img src="" alt="Eastern Conference Champion Logo">
            <div class="team--has-show">
              <span id="team2check" class="has--base100"></span>
              <span class="has--base80"><?php echo $modaleasternresult ?></span>
            </div>
          </div>
          <div class="team--has-pick team--champion">
            <img src="" alt="NBA Champion Logo">
            <div class="team--has-show">
              <span id="selectedTeam" class="has--base100"></span>
              <span class="has--base80"><?php echo $modalfinalresult ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>