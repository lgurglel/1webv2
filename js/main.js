let
    X,
    Y,
    R,
    answerValues = document.getElementById("answerValues"),
    error = document.getElementById("error");

function validateX() {
    let checkboxes = document.getElementsByName("X")
    let checkboxCounter = 0
    let checkboxesChecked = []
    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            checkboxCounter++;
        }
    }
    if (checkboxCounter > 1) {
        error.textContent = "Выбирите только один X";
        for (let checkbox of checkboxes) {
            checkbox.checked = false;
        }
        return false;
    } else {
        if (checkboxCounter === 0) {
            error.textContent = "Выбирите один X";
            return false;
        } else {
            error.textContent = "";
            for (var index = 0; index < checkboxes.length; index++) {
                if (checkboxes[index].checked) {
                    checkboxesChecked.push(checkboxes[index].value);
                }
            }
            X = checkboxesChecked;
            return true;
        }
    }
}

function validateY() {
    let Y2 = document.getElementById("Y").value.replace(',', '.')
    if (Y2.trim() === "") {
        error.textContent = "Заполните поле Y";
        return false;
    } else if (!isFinite(Y2)) {
        error.textContent = "Y должно быть числом";
        return false;
    } else {
        if (Y2 > -3 && Y2 < 3) {
            Y = Y2;
            return true;
        } else {
            error.textContent = "Y должно быть в диапазоне (-3; 3)";
            return false;
        }
    }
}

function validateR() {
    let R2 = document.getElementById("R").value.replace(',', '.')
    if (R2.trim() === "") {
        error.textContent = "Заполните поле R";
        return false;
    } else if (!isFinite(R2)) {
        error.textContent = "R должно быть числом";
        return false;
    } else {
        if (R2 > 1 && R2 < 4) {
            R = R2;
            return true;
        } else {
            error.textContent = "R должно быть в диапазоне (1; 4)";
            return false;
        }
    }
}

function validateForm() {
    return (validateX() && validateY() && validateR());
}

const submit = function (e) {
    e.preventDefault();
    if (!(validateForm())) return;
    fetch("php/functions.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"},
        body: "&X=" + X + "&Y=" + Y + "&R=" + R +
            "&timezone=" + Intl.DateTimeFormat().resolvedOptions().timeZone
    }).then(response => response.text()).then(function (serverAnswer) {
        answerValues.innerHTML = serverAnswer;
    }).catch(err => createNotification("Ошибка HTTP. Повторите попытку позже." + err));
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('submitButton').addEventListener('click', submit);
});

document.getElementById("clearButton").onclick = function () {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/clear.php');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            answerValues.innerHTML = "";
        }
    }
    xhr.send()
}

