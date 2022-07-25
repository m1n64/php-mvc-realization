<?php
 /** @var array $userIp*/
?>
<section id="aboutPage">
    <div class="card" x-data="aboutpage">
        <div class="card-body">
            <div class="row p-2">
                <div class="col-2">
                    <img src="storage/about/chiefwiggum.jpg" class="img-fluid rounded" width="200" alt="Wild Landscape" />
                </div>
                <div class="col-8 description-base">
                    <h4>С ИДИОТА ДО ДЖУНА | <small class="text-muted">АЙТЯ ПАНК</small></h4>
                    <p class="lead">
                        На нашем канале вы можете прочитать много чего касаемо нашей любимой атишечки, а так же пообщаться с такими
                        же курдошлёпанцеами как и ты сам. У нас тут все пишут на PHP, так что если интересно - то welcome to the club, buddy.
                    </p>

                </div>
            </div>
            <div class="row p-2">
                <div class="col-12">
                    <p class="note note-light">
                        <strong>АТТЕНШЕН</strong> У нас тут есть матершина, шутки ниже пояса (ну вообще-то большой грех - не подстебать
                        какого-нибудь битриксоида, кубоидов-битриксоидов у нас тут не любят) и вообще, готов ли ты? Если готов - то ссылочка ниже!
                    </p>
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram fa-2x" style="color: #0865fd"></i> <a href="https://t.me/fromidiottojunior" class="margin-left-10px">@fromidiottojunior</a>
                    </div>
                </div>
            </div>

            <hr class="divider-horizontal" />
            <div class="d-flex flex-column p-2">
                <div class="justify-content-center">
                    Your Time: <span x-text="time"></span>
                </div>
                <div class="padding-10px bg-dark bg-gradient rounded bg-opacity-25">
                    In site: <strong x-text="seconds"></strong> seconds.
                </div>
            </div>

        </div>
    </div>

    <div class="card margin-top-10px">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <strong><?= $userIp["ip"] ?></strong> - <?= $userIp["country"] ?>, <?= $userIp["city"] ?>
            </div>
        </div>
    </div>

    <div class="card margin-top-15px">
        <div class="card-body">

            <form action="/about/saveIp" method="post">
                <input type="hidden" name="id" value="<?= $userIp["id"] ?>">

                <div class="form-outline mb-4">
                    <input type="text" required name="country" id="country" class="form-control" value="<?= $userIp["country"] ?>" />
                    <label class="form-label" for="country">Country</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="text" required id="city" name="city" class="form-control" value="<?= $userIp["city"] ?>" />
                    <label class="form-label" for="city">City</label>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</section>
