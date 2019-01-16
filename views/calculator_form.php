<!DOCTYPE html>
<html>
    <head>
        <title>Insurance Calculator</title>
    </head>
    <body>
        <h1>Insurance Calculator</h1>
        <form id="calculator-form">
            <div>
                <label for="carValue">Estimated Car Value</label>
                <input type="number" min="100" max="100000" name="carValue" id="carValue">
            </div>
            <div>
                <label for="taxPerc">Tax Percentage</label>
                <input type="number" min="0" max="100" name="taxPerc" id="taxPerc">
            </div>
            <div>
                <label for="installmentsNum">Number of Installments</label>
                <input type="number" min="1" max="12" name="installmentsNum" id="installmentsNum">
            </div>
            <div>
                <input type="submit" value="Calculate" id="calculate-btn">
            </div>
        </form>
        <script type="text/javascript" src="assets/js/calculator.js"></script>
    </body>
</html>