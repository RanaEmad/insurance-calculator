(function () {
    var calculateBtn = document.getElementById("calculate-btn");
    calculateBtn.addEventListener("click", calculateCost);
    function calculateCost(e) {
        e.preventDefault();
        var calculatorForm = document.getElementById("calculator-form");
        var data = new FormData(calculatorForm);
        var url = "index.php";
        var req = new XMLHttpRequest();
        req.addEventListener("load", function (e) {
            var res = JSON.parse(e.target.responseText);
            if (!res.result) {
                show_validation_errors(res.validation_errors);
            }
        });
        req.addEventListener("error", function () {
            alert('The form could not be submitted. Please, refresh and try again');
        });
        req.open("POST", url, true);
        req.send(data);

    }
    function show_validation_errors(errors_obj) {
        var validation_errors = "";
        for (var key in errors_obj) {
            validation_errors += errors_obj[key];
        }
        document.getElementById("validation-errors").innerHTML = validation_errors;
    }
})();