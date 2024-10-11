let currentInput = '';
let lastResult = '';

function clearDisplay() {
    currentInput = '';
    lastResult = '';
    document.getElementById('display').value = '';
}

function clearEntry() {
    currentInput = currentInput.slice(0, -1);
    document.getElementById('display').value = currentInput;
}

function deleteLast() {
    currentInput = '';
    document.getElementById('display').value = lastResult;
}

function appendNumber(number) {
    currentInput += number;
    document.getElementById('display').value = currentInput;
}

function appendOperator(operator) {
    currentInput += operator;
    document.getElementById('display').value = currentInput;
}

function calculateResult() {
    try {
        lastResult = eval(currentInput);
        document.getElementById('display').value = lastResult;
        currentInput = lastResult.toString();
    } catch (error) {
        document.getElementById('display').value = 'Error';
    }
}
