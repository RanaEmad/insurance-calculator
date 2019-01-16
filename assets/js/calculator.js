(function () {
    var calculateBtn = document.getElementById("calculate-btn");
    calculateBtn.addEventListener("click", calculateCost);
    function calculateCost(e) {
        e.preventDefault();
        var calculatorForm = document.getElementById("calculator-form");
        var data = new FormData(calculatorForm);
        var url="index.php";
        var req = new XMLHttpRequest();
        req.addEventListener("load", function (e) {
            var res = JSON.parse(e.target.responseText);
            alert(res);
        });
        req.addEventListener("error", function () {
            alert('The form could not be submitted. Please, refresh and try again');
        });
        req.open("POST", url, true);
        req.send(data);

    }
})();