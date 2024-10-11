function addNumbers() {
    const num1 = document.getElementById('num1').value;
    const num2 = document.getElementById('num2').value;
    
    // Cek apakah input kosong
    if (num1 === '' || num2 === '') {
        alert('HARUS DI ISI! LAWAK!!!');
        return;  // Hentikan eksekusi jika input kosong
    }

    const number1 = parseFloat(num1);
    const number2 = parseFloat(num2);
    
    if (!isNaN(number1) && !isNaN(number2)) {
        const result = number1 + number2;
        document.getElementById('HASIL').innerText = `Result: ${result}`;
    } else {
        document.getElementById('HASIL').innerText = 'Please enter valid numbers';
    }
}

function resetFields() {
    // Mengosongkan input dan hasil
    document.getElementById('num1').value = '';
    document.getElementById('num2').value = '';
    document.getElementById('HASIL').innerText = 'Result: ';
}
