<?php
use App\Constants\GoodBuyingProcessConstant;use App\Models\GoodCategory;
?>
<div class="good-modal__logo">
    <img src="/images/pay-window/earth.png" alt="">
</div>
<div class="good-modal">
    <div class="good-modal__header">
        О ТОВАРАХ
    </div>
    <div class="good-modal__body">
        <div class="goods-list-wrapper">
            <button class="accordion">OCEAN</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                        Открыть виртуальный верстак <span>/craft</span>
                    </li>
                    <li>
                        Восполнить голод <span>/feed</span>
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Точки дома: <span>2</span>
                    </li>
                    <li>
                        Блоков региона: <span>3</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>5</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">TURTLE</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                        Открыть ткаций станок <span>/loom</span>
                    </li>
                    <li>
                        Восполнение здоровья <span>/heal</span>
                    </li>
                    <li>
                        Надеть предмет на голову  <span>/hat</span>
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Точки дома: <span>3</span>
                    </li>
                    <li>
                        Блоков региона: <span>4</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>7</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">BANGLADESH</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                        Потушить себя  <span>/ext</span>
                    </li>
                    <li>
                        Открыть стол картографа <span>/cartographytable</span>
                    </li>
                    <li>
                        Узнать крафт <span>/recipe</span> (предмет)
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Точки дома: <span>3</span>
                    </li>
                    <li>
                        Блоков региона: <span>5</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>9</span>
                    </li>
                    <li>
                        Множитель монет <span>1.25x</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">MERMAID</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                        Установка личного времени суток <span>/ptime</span>
                    </li>
                    <li>
                        Починить предмет в руке <span>/fix</span>
                    </li>
                    <li>
                        Снятие чар <span>/grindstone </span>
                    </li>
                    <li>
                        Просмотр <span>/ec</span> игрока
                    </li>
                    <li>
                        Быстрый крафт <span>/condense</span>
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Точки дома: <span>5</span>
                    </li>
                    <li>
                        Блоков региона: <span>6</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>12</span>
                    </li>
                    <li>
                        Множитель монет <span>1.50x</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">AFINA</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                       Игроки поблизости <span>/near</span>
                    </li>
                    <li>
                        Заглянуть в инвентарь игрока <span>/invsee</span>
                    </li>
                    <li>
                        Ремонт всех предметов в инвентаре <span>/fix all</span>
                    </li>
                    <li>
                        Написать объявление в чат <span>/bc</span>
                    </li>
                    <li>
                        Выдать игроку  мут <span>/tempmute</span>
                    </li>
                    <li>
                        Бесконечная наковальня <span>/anvil</span>
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Точки дома: <span>6</span>
                    </li>
                    <li>
                        Блоков региона: <span>6</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>15</span>
                    </li>
                    <li>
                        Множитель монет <span>1.75x</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">STARFISH</button>
            <div class="panel">
                <h3>Команды:</h3>
                <ul>
                    <li>
                        Уникальный кит STAR в который входит кирка на эффективность 5, большой приват спавнер и яйцо призыва скелета
                    </li>
                    <li>
                        Размутить игрока <span>/unmute</span>
                    </li>
                    <li>
                        Виртуальная мусорка <span>/trash</span>
                    </li>
                    <li>
                        Призвать молнию <span>/lightning</span>
                    </li>
                    <li>
                        Улучшить снаряжение <span>/smithingtable</span>
                    </li>
                    <li>
                        Забанить игрока <span>/tempban</span>
                    </li>
                </ul>
                <h3>Дополнительно:</h3>
                <ul>
                    <li>
                        Возможность заходить на (RED)заполненные(RED) сервера
                    </li>
                    <li>
                        Точки дома: <span>7</span>
                    </li>
                    <li>
                        Блоков региона: <span>7</span>
                    </li>
                    <li>
                        Слотов на Аукционе: <span>18</span>
                    </li>
                    <li>
                        Множитель монет <span>2x</span>
                    </li>
                </ul>
            </div>
            <button class="accordion">Разбан</button>
            <div class="panel">
                Разблокировка игрового аккаунта на сервере.
            </div>
            <button class="accordion">Личный титул</button>
            <div class="panel">
                Cоздание уникального титула с вашими цветами. После покупки обязательно напиши нам в группу <a href="https://vk.com/astrosea">ВК</a>
            </div>
        </div>
    </div>
    <div class="good-modal__footer"></div>
</div>
