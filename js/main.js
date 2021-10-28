$(function() {
    let error = document.getElementById("error")

    function validateX() {
        let checkboxes = document.getElementsByName("X")
        let checkboxCounter = 0
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
                return true;
            }
        }
    }

    function validateY() {
        let Y2 = document.getElementById("Y").value.replace(',', '.')
        if (Y2.trim() === "") {
            error.textContent="Заполните поле Y";
            return false;
        } else if (!isFinite(Y2)) {
            error.textContent="Y должно быть числом";
            return false;
        } else {
            if (Y2 >= -3 && Y2 <= 3) {
                return true;
            }
            else {
                error.textContent ="Y должно быть в диапазоне (-3; 3)";
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
            error.textContent ="R должно быть числом";
            return false;
        } else {
            if (R2 >= 1 && R2 <= 4) {
                return true;
            }
            else {
                error.textContent = "R должно быть в диапазоне (1; 4)";
                return false;
            }
        }
    }

    function validateForm() {
        return validateX() & validateY() & validateR();
    }

    $('#form').on('submit', function(event) {
        event.preventDefault();
        if (!validateForm()) return;
        $.ajax({
            url: "php/functions.php",
            method: "POST",
            data: $(this).serialize() + "&timezone=" + new Date().getTimezoneOffset(),
            dataType: "html",
            beforeSend: function (){
                $(".button").attr("disabled", "disabled");
            },
            success: function(data){
                console.log(data);
                $(".button").attr("disabled", false);
                $("#resultTable").append(data);
            },
            error: function(error){
                console.log(error);
                $(".button").attr("disabled", false);
            }
        });
    });
});
