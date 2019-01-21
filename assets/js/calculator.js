(function () {
    var calculateBtn = document.getElementById("calculate-btn");
    calculateBtn.addEventListener("click", calculateCost);
    function concatZero(value){
        if(value<10){
            value= "0"+value;
        }
        return value;
    }
    function calculateCost(e) {
        e.preventDefault();
        var date = new Date();
        var dateString= date.getFullYear()+"-"+concatZero(date.getMonth()+1)+"-"+concatZero(date.getDate())+" "+concatZero(date.getHours())+":"+concatZero(date.getMinutes());
        document.getElementById('date').value = dateString;
        var calculatorForm = document.getElementById("calculator-form");
        var data = new FormData(calculatorForm);
        var url = "index.php";
        var req = new XMLHttpRequest();
        req.addEventListener("load", function (e) {
            var res = JSON.parse(e.target.responseText);
            if (!res.result) {
                showValidationErrors(res.validationErrors);
            }
            else {
                buildTable(res.total, res.installment);
            }
        });
        req.addEventListener("error", function () {
            alert('The form could not be submitted. Please, refresh and try again');
        });
        req.open("POST", url, true);
        req.send(data);

    }
    function showValidationErrors(errors_obj) {
         document.getElementById("price-matrix-wrapper").innerHTML="";
        var validation_errors = "";
        for (var key in errors_obj) {
            validation_errors += errors_obj[key];
        }
        document.getElementById("validation-errors").innerHTML = validation_errors;
        document.getElementById("validation-errors").style.display="block";
    }
    function buildTable(total, installment) {
        document.getElementById("validation-errors").style.display="none";
        document.getElementById("validation-errors").innerHTML="";
        var table = '<table id="price-matrix" border="1">\n\
                    <thead>\n\
                        <tr>\n\
                            <th></th>\n\
                            <th>Policy</th>\n\
                        <tr>\n\
                    </thead>\n\
                    <tbody>\n\
                        <tr>\n\
                            <td>Value</td>\n\
                        </tr>\n\
                        <tr>\n\
                            <td>Base Premium (11%)</td>\n\
                        </tr>\n\
                        <tr>\n\
                            <td>Commission (17%)</td>\n\
                        </tr>\n\
                        <tr>\n\
                            <td>Tax (10%)</td>\n\
                        </tr>\n\
                        <tr>\n\
                            <td><strong>Total cost</strong></td>\n\
                        </tr>\n\
                    </tbody>\n\
        </table>';
        document.getElementById("price-matrix-wrapper").innerHTML = table;


        var table = document.getElementById("price-matrix");
        var thead = table.getElementsByTagName('thead')[0];
        var tbody = table.getElementsByTagName('tbody')[0];

        var tr = tbody.getElementsByTagName('tr');

        tr[0].innerHTML += "<td>" + total.carValue + "</td>";
        tr[1].innerHTML += "<td>" + total.basePrice + "</td>";
        tr[2].innerHTML += "<td>" + total.commission + "</td>";
        tr[3].innerHTML += "<td>" + total.tax + "</td>";
        tr[4].innerHTML += "<td>" + total.sum + "</td>";

        if (total.installmentsNum > 1) {
            var theadTr = thead.getElementsByTagName('tr')[0];
            for (var i = 0; i < total.installmentsNum; i++) {
                theadTr.innerHTML += "<th>Installment " + (i+1) + "</th>";
                tr[0].innerHTML += "<td></td>";
                tr[1].innerHTML += "<td>" + installment.basePrice[i] + "</td>";
                tr[2].innerHTML += "<td>" + installment.commission[i] + "</td>";
                tr[3].innerHTML += "<td>" + installment.tax[i] + "</td>";
                tr[4].innerHTML += "<td>" + installment.sum[i] + "</td>";
            }
        }
    }
})();