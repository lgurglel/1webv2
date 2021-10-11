<?php
include "functions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>1 Лабораторная</title>
    <style>
        body {
            background: #DFB9D3;
            color: black;
            font-family: Arial;
            font-size: 20px;
            line-height: 50px;
        }

        header {
            text-align: center;
            font-size: 50px;
            font-family: Gabriola;

        }

        .right {
            float: right;
        }

        .centre {
            text-align: center;
            margin: auto;
        }

        .left {
            float: left;
        }

        #mainTable {
            max-width: 1000px;
        }

        #clock {
            color: black;
            font-weight: bold;
            font-size: 30px;
        }


    </style>
</head>
<body>
<header>
    <div>Степанов Денис Александрович P3215</div>
    <div>Вариант 15018</div>
</header>

<main>
    <form>
        <table border="1" width="100%" id="mainTable" class="centre">
            <tr>
                <td colspan="2">
                    <div id="clock"></div>
                </td>
            </tr>
            <tr>
                <th width="50%">
                    <div> Выберите X:</div>
                    <div> Введите Y:</div>
                    <div> Введите R:</div>
                </th>
                <th width="50%">
                    <img class="right" src="task.jpg" width="432" height="327" border="1">
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    Кнопка проверки
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        Результат
                </td>
            </tr>
        </table>
    </form>
</main>
<script src="js/main.js"></script>
</body>
</html>
