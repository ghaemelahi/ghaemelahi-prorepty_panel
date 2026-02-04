function separate(input) {
    for (let i = 0; i < 10; i++) {
        input.value = input.value.replace(String.fromCharCode(i + 1776), i.toString());
    }
    var inputNumber = input.value.replace(/\D/g, "");
    input.value = inputNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}